<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $clients = $user->clients()->get();

        return response()->json($clients);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'active' => 'required|boolean',
            'fee' => 'required|numeric',
        ]);

        $client = Client::create($validatedData);

        $user = auth()->user();
        $user->clients()->attach($client->id, ['owner' => true]);

        return response()->json($client, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        $user = auth()->user();
        if (!$user->clients->contains($client)) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        return response()->json($client);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $user = auth()->user();
        if (!$user->clients->contains($client)) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'active' => 'boolean',
            'fee' => 'numeric',
        ]);

        $client->update($validatedData);

        return response()->json($client);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $user = auth()->user();
        if (!$user->clients->contains($client)) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        $client->delete();

        return response()->json(null, 204);
    }
}
