<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Seller;
use App\Models\Sequence;
use Illuminate\Http\Request;

class SequenceController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $clientIds = $user->clients->pluck('id');
        $sequences = Sequence::whereIn('client_id', $clientIds)->get();

        return response()->json($sequences);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'generator' => 'required|string|max:255',
            'last_used' => 'required|string|max:255',
        ]);

        $sequence = Sequence::create($validatedData);
        return response()->json($sequence, 201);
    }

    public function show(Sequence $sequence)
    {
        return response()->json($sequence);
    }

    public function update(Request $request, $id)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $sequence = Sequence::where('id', $id)->first();

        if (!$sequence) {
            return response()->json(['error' => 'Sequence not found'], 404);
        }

        if (!$user->clients->contains($sequence->client)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $this->authorize('update', $sequence);

        $validatedData = $request->validate([
            'last_used' => 'string|max:255',
        ]);

        $sequence->update($validatedData);

        return response()->json($sequence);
    }

    public function destroy(Sequence $sequence)
    {
        $sequence->delete();
        return response()->json(null, 204);
    }

    private function nextInSequence($id)
    {
        $sequence = Sequence::find($id);

        $currentYearFull = date("Y");
        $currentYearShort = date("y");
        $currentMonth = date("m");
        $currentDay = date("d");

        $pattern = $sequence->generator;
        $last_sequence = $sequence->last_used;

        if ($last_sequence) {
            // Extract the sequence number part from the last sequence
            preg_match('/S+/', $pattern, $matches);
            $lastSequenceNumber = substr($last_sequence, -strlen($matches[0]));
            $newSequenceNumber = str_pad((int)$lastSequenceNumber + 1, strlen($matches[0]), "0", STR_PAD_LEFT);
        } else {
            // Start sequence from 1 if there is no last sequence
            preg_match('/S+/', $pattern, $matches);
            $newSequenceNumber = str_pad(1, strlen($matches[0]), "0", STR_PAD_LEFT);
        }

        // Replace placeholders in the pattern
        return str_replace(
            ["YYYY", "YY", "MM", "DD", str_repeat("S", strlen($matches[0]))],
            [$currentYearFull, $currentYearShort, $currentMonth, $currentDay, $newSequenceNumber],
            $pattern
        );
    }

    public function next(Request $request, $id)
    {
        $next = $this->nextInSequence($id);

        $request->replace(['last_used' => $next]);

        return $this->update($request, $id);
    }

    public function nextWithHash(Request $request, $hash, $id)
    {
        $sequence = Sequence::where('id', $id)->first();

        if (!$sequence) {
            return response()->json(['error' => 'Sequence not found'], 404);
        }

        $client = Client::where('id', $sequence->client_id)->first();

        if (!$client) {
            return response()->json(['error' => 'Client not found'], 404);
        }

        $seller = Seller::where('hash', $hash)->first();

        if (!$seller) {
            return response()->json(['error' => 'Seller not found'], 404);
        }

        if ($client->id !== $seller->client_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $next = $this->nextInSequence($id);

        $seller = Seller::where('hash', $hash)->first();
        if ($seller) {

            $request->replace(['last_used' => $next]);

            $validatedData = $request->validate([
                'last_used' => 'string|max:255',
            ]);

            $sequence->update($validatedData);

            return response()->json($sequence);
        }

        return response()->json(['error' => 'Seller not found'], 404);
    }
}
