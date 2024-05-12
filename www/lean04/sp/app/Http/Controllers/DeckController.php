<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Deck;
use Illuminate\Http\Request;

class DeckController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cards = Deck::all();
        return response()->json($cards);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $card = Deck::create($request->all());
        return response()->json($card, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $card = Deck::findOrFail($id);
        return response()->json($card);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $card = Deck::findOrFail($id);
        $card->update($request->all());
        return response()->json($card);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Deck::destroy($id);
        return response()->json(null, 204);
    }
}
