<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Connection;

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
}
