<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Models\Ticket;
use App\Models\User;

class PaymentController extends Controller
{
    public function loadForm(Request $request) {

        $tickets = session("bookedTickets", []);
        $now = Carbon::now();
        $validTickets = [];
        $totalPrice = 0;
        $type = "tickets";
        
        foreach ($tickets as $ticket) {
            if (Carbon::parse($ticket["reserved_until"])->isAfter($now)) {
                $validTickets[] = $ticket;
                $totalPrice += $ticket["price"];
            }
        }
        
        if ($request->exists("membershipPrice")) {
            $totalPrice = $request->input("membershipPrice");
            $type = "membership";
        }

        if ($totalPrice == 0) {
            return redirect()->route("index");
        }

        return view("payment")->with(["type" => $type, "totalPrice" => $totalPrice]);
    }

    public function pay(Request $request) {
        if ($request->type == "membership") {
            $user = Auth::user();

            if ($request->price == 9999) {
                $user->membership = 1;
            } else {
                $user->membership = 2;
            }

            $user->save();
            return redirect()->route("index")->with("success", "Členství bylo zakoupeno.");
        }

        $bookedTickets = Ticket::where("reserved", true)
        ->where("reserved_until", ">", Carbon::now())
        ->where("passenger_id", Auth::user()->id)
        ->get();

        foreach ($bookedTickets as $ticket) {
            $ticket->reserved = false;
            $ticket->reserved_until = null;
            $ticket->save();
        }

        Session::put("bookedTickets", []);

        return redirect()->route("index")->with("success", "Vaše letenka byla uhrazena.");
    }
}
