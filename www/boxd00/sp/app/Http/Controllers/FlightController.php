<?php

namespace App\Http\Controllers;

use App\Models\Connection;
use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function find(Request $request)
    {
        $ticketType = $request->input("ticketType");
        $from = $request->input("from");
        $to = $request->input("to");
        $departure = $request->input("departure");
        $return = $request->filled("return") ? $request->input("return") : null;

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

        return view("connections", [
            "flights" => $flights,
            "departure" => $departure,
            "return" => $return
        ]);
    }
}
