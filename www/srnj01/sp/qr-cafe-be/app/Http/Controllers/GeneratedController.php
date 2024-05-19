<?php

namespace App\Http\Controllers;

use App\Models\Generated;
use App\Models\Seller;
use Illuminate\Http\Request;

class GeneratedController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('seller_hash')) {
            // Get generated entries by seller hash
            $seller = Seller::where('hash', $request->input('seller_hash'))->first();
            if ($seller) {
                $generated = Generated::where('seller_id', $seller->id)->get();
                return response()->json($generated);
            }
            return response()->json(['error' => 'Seller not found'], 404);
        }

        $user = auth()->user();
        if ($user) {
            $clients = $user->clients->pluck('id');
            $generated = Generated::whereIn('seller_id', function ($query) use ($clients) {
                $query->select('id')->from('sellers')->whereIn('client_id', $clients);
            })->get();
            return response()->json($generated);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function show(Request $request, $id)
    {
        $generated = Generated::find($id);

        if (!$generated) {
            return response()->json(['error' => 'Generated entry not found'], 404);
        }

        $seller = $generated->seller;

        if ($request->has('seller_hash') && $request->input('seller_hash') === $seller->hash) {
            return response()->json($generated);
        }

        $user = auth()->user();
        if ($user && $user->clients->contains($seller->client)) {
            return response()->json($generated);
        }

        return response()->json(['error' => 'Unauthorized'], 403);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'amount' => 'required|numeric',
            'variable_symbol' => 'required|string|max:255',
            'seller_hash' => 'nullable|string|exists:sellers,hash',
            'account_id' => 'required|exists:accounts,id',
            'success' => 'boolean',
        ]);

        $validatedData['success'] = $request->input('success', true);

        if ($request->has('seller_hash')) {
            $seller = Seller::where('hash', $request->input('seller_hash'))->first();
            if (!$seller) {
                return response()->json(['error' => 'Seller not found'], 404);
            }
        } else {
            $user = auth()->user();
            if (!$user) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $seller = Seller::whereIn('client_id', $user->clients->pluck('id'))->first();
            if (!$seller) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
        }

        $generated = Generated::create([
            'amount' => $validatedData['amount'],
            'variable_symbol' => $validatedData['variable_symbol'],
            'seller_id' => $seller->id,
            'account_id' => $validatedData['account_id'],
            'success' => $validatedData['success'],
        ]);

        return response()->json($generated, 201);
    }

    public function update(Request $request, $id)
    {
        $generated = Generated::find($id);

        if (!$generated) {
            return response()->json(['error' => 'Generated entry not found'], 404);
        }

        $seller = $generated->seller;

        $validatedData = $request->validate([
            'amount' => 'sometimes|required|numeric',
            'variable_symbol' => 'sometimes|required|string|max:255',
            'account_id' => 'sometimes|required|exists:accounts,id',
            'success' => 'sometimes|required|boolean',
        ]);

        if ($request->has('seller_hash') && $request->input('seller_hash') === $seller->hash) {
            $generated->update($validatedData);
            return response()->json($generated);
        }

        $user = auth()->user();
        if ($user && $user->clients->contains($seller->client)) {
            $generated->update($validatedData);
            return response()->json($generated);
        }

        return response()->json(['error' => 'Unauthorized'], 403);
    }

    public function destroy(Request $request, $id)
    {
        $generated = Generated::find($id);

        if (!$generated) {
            return response()->json(['error' => 'Generated entry not found'], 404);
        }

        $seller = $generated->seller;

        if ($request->has('seller_hash') && $request->input('seller_hash') === $seller->hash) {
            $generated->delete();
            return response()->json(null, 204);
        }

        $user = auth()->user();
        if ($user && $user->clients->contains($seller->client)) {
            $generated->delete();
            return response()->json(null, 204);
        }

        return response()->json(['error' => 'Unauthorized'], 403);
    }
}
