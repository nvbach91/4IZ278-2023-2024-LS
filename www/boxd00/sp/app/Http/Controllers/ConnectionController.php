<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Connection;
use App\Models\Destination;
use PHPUnit\Event\Telemetry\Duration;

class ConnectionController extends Controller
{
    public function find(Request $request)
    {
        // Retrieve the "from" and "to" locations from the form input
        $from = $request->input('from');
        $to = $request->input('to');

        // Query the database for connections based on the "from" and "to" locations
        $connections = Connection::where('from_code', $from)->where('to_code', $to)->get();

        // Pass the connections to a view for display
        return view('connections', ['connections' => $connections]);
    }

    public function loadCreateForm() {
        if (!Auth::user()->is_admin) {
            return redirect()->route("index");
        }

        $destinations = Destination::orderBy("country")->orderBy("name")->get();
        $groupedDestinations = $destinations->groupBy("country");

        return view("newconnection", [
            "destinations" => $destinations,
            "groupedDestinations" => $groupedDestinations
        ]);
    }

    public function create(Request $request) {
        $connection = new Connection();

        if (Connection::where("flight_code", $request->input("code"))->exists()) {
            return redirect()->route("newconnection")->with("alert", "Spojení již existuje.");
        }

        $connection->flight_code = $request->input("code");
        $connection->from_code = $request->input("from");
        $connection->to_code = $request->input("to");
        $connection->day = $request->input("day");
        $connection->time = $request->input("time");
        $connection->duration = $request->input("duration");
        $connection->price = $request->input("price");

        $connection->save();

        return redirect()->route("newconnection")->with("alert", "Spojení bylo přidáno!");
    }
}
