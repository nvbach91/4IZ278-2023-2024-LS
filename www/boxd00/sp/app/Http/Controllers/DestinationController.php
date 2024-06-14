<?php
namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use function Symfony\Component\String\b;

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

    public function loadCreateForm() {
        if (!Auth::user()->is_admin) {
            return redirect()->route("index");
        }

        return view("newdestination");
    }

    public function create(Request $request) {
        $destination = new Destination();

        if (Destination::where("airport_code", $request->input("airport_code"))->exists()) {
            return redirect()->route("newdestination")->with("alert", "Destinace již existuje.");
        }

        $destination->airport_code = $request->input("code");
        $destination->name = $request->input("name");
        $destination->country = $request->input("country");

        $destination->save();

        return redirect()->route("newdestination")->with("alert", "Destinace byla přidána!");
    }
}
