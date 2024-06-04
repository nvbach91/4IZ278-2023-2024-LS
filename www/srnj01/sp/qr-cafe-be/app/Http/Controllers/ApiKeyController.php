<?php

namespace App\Http\Controllers;

use App\Models\ApiKey;
use Illuminate\Http\Request;

class ApiKeyController extends Controller
{
    public function index()
    {
        return response()->json(ApiKey::all());
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'key' => 'required|string|max:255',
            'account_id' => 'required|exists:accounts,id',
        ]);

        $apiKey = ApiKey::create($validatedData);
        return response()->json($apiKey, 201);
    }

    public function show(ApiKey $apiKey)
    {
        return response()->json($apiKey);
    }

    public function update(Request $request, ApiKey $apiKey)
    {
        $validatedData = $request->validate([
            'key' => 'string|max:255',
            'account_id' => 'exists:accounts,id',
        ]);

        $apiKey->update($validatedData);
        return response()->json($apiKey);
    }

    public function destroy(ApiKey $apiKey)
    {
        $apiKey->delete();
        return response()->json(null, 204);
    }
}
