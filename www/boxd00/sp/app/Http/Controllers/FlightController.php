<?php

namespace App\Http\Controllers;

use App\Models\Connection;
use App\Models\Flight;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FlightController extends Controller
{
    public function find(Request $request)
    {
        $ticketType = $request->input("ticketType");
        $from = $request->input("from");
        $to = $request->input("to");
        $departure = $request->input("departure");
        $return = $request->filled("return") ? $request->input("return") : null;
        // if ($request->exists("page")) {
        //     $page = $request->exists("page");
        // } else {
        //     $page = 1;
        // }

        $flightCodes = Connection::where("from_code", $from)
        ->where("to_code", $to)
        ->pluck("flight_code");

        $flights = Flight::whereIn('flight_code', $flightCodes)
        ->whereDate("date", ">=", $departure)
        ->orderBy("date")
        ->with("connection")
        ->withCount(['tickets as economy_tickets_count' => function ($query) {
            $query->where('class', 0);
        }])
        ->withCount(['tickets as business_tickets_count' => function ($query) {
            $query->where('class', 1);
        }])
        ->get()
        ->groupBy("flight_code");

        // $pageSize = 10;
        // $pageCount = intdiv(count($allFlights), $pageSize);

        // $flights = array_slice($allFlights->toArray(), $pageSize*($page-1), $pageSize*$page);

        return view("connections", [
            // "pageCount" => $pageCount,
            "flights" => $flights,
            "departure" => $departure,
            "return" => $return
        ]);
    }

    public function list() {
        if (!Auth::user()->is_admin) {
            return redirect()->route("index"); // unauthorized access
        }

        $flights = Flight::with('connection')
        ->join('connection', 'flight.flight_code', '=', 'connection.flight_code')
        ->orderBy('flight.date')
        ->orderBy('connection.time')
        ->select('flight.*')
        ->get();

        return view("flights", [
            "flights" => $flights
        ]);
    }

    public function info($fid) {
        if (!Auth::user()->is_admin) {
            return redirect()->route("index");
        }

        $flight = Flight::findOrFail($fid);
        $tickets = Ticket::where('flight_id', $fid)->orderBy("seat")->get();

        return view("flight", [
            "flight" => $flight,
            "tickets" => $tickets
        ]);
    }

    public function loadCreateForm() {
        if (!Auth::user()->is_admin) {
            return redirect()->route("index");
        }

        $connections = Connection::orderBy("flight_code")->get();

        return view("newflight", [
            "connections" => $connections
        ]);
    }

    public function create(Request $request) {
        $flight = new Flight();
        // $connection = Connection::findOrFail($request->input("connection"));
        $connection = Connection::where('flight_code', $request->input("connection"))->first();

        if (Carbon::parse($request->input("date"))->dayOfWeek != $connection->day) {
            $days = ["pondělí", "úterý", "středa", "čtvrtek", "pátek", "sobota", "neděle"];
            return redirect()->route("newflight")->with("alert", "Den musí být " . $days[$connection->day-1] . "!");
        }

        $flight->flight_code = $request->input("connection");
        $flight->date = $request->input("date");
        $flight->delay = 0;

        $flight->save();

        return redirect()->route("newflight")->with("alert", "Let byl vytvořen!");
    }
}
