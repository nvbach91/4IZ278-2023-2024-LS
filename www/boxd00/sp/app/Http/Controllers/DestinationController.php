<?php
namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::orderBy("country")->orderBy("name")->get();
        $groupedDestinations = $destinations->groupBy("country");

        return view('index', compact('groupedDestinations'));
    }

    public function destinations() {
        $destinations = Destination::orderBy("country")->orderBy("name")->get();
        $groupedDestinations = $destinations->groupBy("country");

        return view('destinations', compact('groupedDestinations'));
    }
}
