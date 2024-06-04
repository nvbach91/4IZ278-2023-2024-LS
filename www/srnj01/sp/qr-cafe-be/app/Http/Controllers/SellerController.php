<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $clientIds = $user->clients->pluck('id');
        $sellers = Seller::whereIn('client_id', $clientIds)->get();

        return response()->json($sellers);
    }

    public function show(Request $request, $id)
    {
        // View a seller by id
        $seller = Seller::where('id', $id)->first();

        if (!$seller) {
            return response()->json(['error' => 'Seller not found'], 404);
        }

        $user = auth()->user();
        if ($user->clients->contains($seller->client)) {
            return response()->json($seller);
        } else if ($request->has('seller_id') && $request->seller_id === $id) {
            return response()->json($seller);
        } else {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    public function showByHash(Request $request, $hash)
    {
        // View a seller by hash
        $seller = Seller::where('hash', $hash)->first();

        if (!$seller) {
            return response()->json(['error' => 'Seller not found'], 404);
        }

        return response()->json($seller);
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        if (!$user || $user->role !== 'client') {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $this->authorize('create', Seller::class);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'hash' => 'required|string|max:255|unique:sellers',
            'active' => 'boolean',
            'client_id' => 'required|exists:clients,id',
        ]);

        $validatedData['active'] = $request->input('active', true);

        // Ensure the client belongs to the user
        if (!$user->clients->contains($validatedData['client_id'])) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $seller = Seller::create($validatedData);

        return response()->json($seller, 201);
    }

    public function update(Request $request, $id)
    {
        $user = auth()->user();

        if (!$user || $user->role !== 'client') {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $seller = Seller::where('id', $id)->first();

        if (!$seller) {
            return response()->json(['error' => 'Seller not found'], 404);
        }

        $this->authorize('update', $seller);

        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'hash' => 'sometimes|required|string|max:255|unique:sellers,hash,' . $seller->id,
            'active' => 'sometimes|required|boolean',
            'client_id' => 'sometimes|required|exists:clients,id',
        ]);

        // Ensure the client belongs to the user
        if (isset($validatedData['client_id']) && !$user->clients->contains($validatedData['client_id'])) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $seller->update($validatedData);

        return response()->json($seller);
    }

    public function destroy(Request $request, $id)
    {
        $user = auth()->user();

        if (!$user || $user->role !== 'client') {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $seller = Seller::where('id', $id)->first();

        if (!$seller) {
            return response()->json(['error' => 'Seller not found'], 404);
        }

        $this->authorize('delete', $seller);

        $seller->delete();

        return response()->json(null, 204);
    }
}
