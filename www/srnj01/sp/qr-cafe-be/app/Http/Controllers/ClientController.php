<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            // Admin can view all clients
            $clients = Client::all();
        } else if ($user->role === 'client') {
            // Client can view their associated clients
            $clients = $user->clients()->get();
        } else {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json($clients);
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        if ($user->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'active' => 'boolean',
            'fee' => 'required|numeric',
        ]);

        $validatedData['active'] = $request->input('active', true);

        $client = Client::create($validatedData);

        return response()->json($client, 201);
    }

    public function show(Client $client)
    {
        $user = auth()->user();

        if ($this->authorize('view', $client)) {
            return response()->json($client);
        } else {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    public function update(Request $request, Client $client)
    {
        $user = auth()->user();

        if ($this->authorize('update', $client)) {
            $validatedData = $request->validate([
                'name' => 'string|max:255',
                'active' => 'boolean',
                'fee' => 'numeric',
            ]);

            $validatedData['active'] = $request->input('active', true);

            $client->update($validatedData);

            return response()->json($client);
        } else {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    public function destroy(Client $client)
    {
        $user = auth()->user();

        if ($this->authorize('delete', $client)) {
            $client->delete();
            return response()->json(null, 204);
        } else {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }
}
