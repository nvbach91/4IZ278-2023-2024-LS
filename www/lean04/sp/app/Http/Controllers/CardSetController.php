<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CardSet;
use Illuminate\Http\Request;

class CardSetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cards = CardSet::all();
        return response()->json($cards);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $card = CardSet::create($request->all());
        return response()->json($card, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $card = CardSet::findOrFail($id);
        return response()->json($card);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $card = CardSet::findOrFail($id);
        $card->update($request->all());
        return response()->json($card);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        CardSet::destroy($id);
        return response()->json(null, 204);
    }
}
