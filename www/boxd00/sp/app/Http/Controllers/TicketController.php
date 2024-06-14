<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Models\Flight;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function beforeBuy(Request $request) {
        $fid = $request->input("fid");
        $flight = Flight::findOrFail($fid);
        $ticketType = $request->input("ticketType");
        $return = $request->input("return");

        $fromDestination = $flight->connection->from_destination;
        $toDestination = $flight->connection->to_destination;

        $occupiedSeats = Ticket::where('flight_id', $fid)
        ->where(function ($query) {
            $query->where('reserved', false)
                ->orWhere(function ($query) {
                    $query->where('reserved', true)
                        ->where('reserved_until', '>', Carbon::now());
                });
        })
        ->pluck('seat')
        ->toArray();

        return view("chooseseat", [
            "flight" => $flight,
            "fromDestination" => $fromDestination,
            "toDestination" => $toDestination,
            "ticketType" => $ticketType,
            "occupiedSeats" => $occupiedSeats,
            "return" => $return
        ]);
    }

    public function add(Request $request) {
        $ticket = new Ticket();

        $ticket->flight_id = $request->input("fid");
        $ticket->passenger_id = Auth::user()->id;
        $ticket->seat = $request->input("seat");
        
        if (str_starts_with($ticket->seat, "B")) {
            $ticket->class = 1;
        } else {
            $ticket->class = 0;
        }

        $ticket->reserved = true;
        $ticket->reserved_until = Carbon::now()->addMinutes(30);
        $ticket->save();
        
        $bookedTickets = Session::get("bookedTickets", []);
        $ticketData = [
            "id" => $ticket->id,
            "flight_id" => $ticket->flight_id,
            "passenger_id" => $ticket->passenger_id,
            "seat" => $ticket->seat,
            "class" => $ticket->class,
            "reserved" => $ticket->reserved,
            "reserved_until" => $ticket->reserved_until,
            "price" => $request->input("price")
        ];
        $bookedTickets[] = $ticketData;
        Session::put("bookedTickets", $bookedTickets);


        if ($request->input("ticketType") == "oneway") {
            return redirect()->route("index");
        } else {
            $flight = Flight::findOrFail($ticket->flight_id);
            // $return = session("return");

            return redirect()->route("connections", [
                "ticketType" => "oneway",
                "from" => $flight->connection->to_code,
                "to" => $flight->connection->from_code,
                "departure" => Carbon::parse($request->input("return"))->format("Y-m-d"),
                "status" => "return"
            ]);
        }
    }

    public function delete(Request $request) {
        $tid = $request->input("tid");

        if (Ticket::where("id", $tid)->exists()) {
            $ticket = Ticket::findOrFail($tid);
            $ticket->delete();
        }

        $bookedTickets = Session::get("bookedTickets", []);
        foreach ($bookedTickets as &$bt) {
            if (!isset($bt["id"])) {
                continue;
            }
            
            if ($bt['id'] == $tid) {
                $bt['reserved_until'] = Carbon::parse($bt["reserved_until"])->format("Y-m-d");
                Session::put("bookedTickets", $bookedTickets);
                break;
            }
        }

        return redirect()->route("cart");
    }

    public function myTickets() {
        $tickets = Ticket::with(['flight' => function ($query) {
                $query->orderBy('date', 'asc');
            }])
            ->with(['flight.connection' => function ($query) {
                $query->orderBy('time', 'asc');
            }])
            ->orderBy('flight_id')
            ->get();
    
        return view("mytickets", ["tickets" => $tickets]);
    }

    public function confirm(Request $request) {
        $seat = $request->input("seat");
        $fid = $request->input("fid");
        $ticketType = $request->input("ticketType");
        $price = $request->input("price");
        $return = $request->input("return");

        $flight = Flight::findOrFail($fid);

        return view("confirmticket", [
            "seat" => $seat,
            "flight" => $flight,
            "ticketType" => $ticketType,
            "price" => $price,
            "return" => $return
        ]);
    }
}
