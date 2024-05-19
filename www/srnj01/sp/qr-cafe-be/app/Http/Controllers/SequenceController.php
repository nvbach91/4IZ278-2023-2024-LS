<?php

namespace App\Http\Controllers;

use App\Models\Sequence;
use Illuminate\Http\Request;

class SequenceController extends Controller
{
    public function index()
    {
        return response()->json(Sequence::all());
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
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

    public function update(Request $request, Sequence $sequence)
    {
        $validatedData = $request->validate([
            'generator' => 'string|max:255',
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
}
