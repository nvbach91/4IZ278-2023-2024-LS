<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        return response()->json(Account::all());
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'client_id' => 'required|exists:clients,id',
            'number' => 'required|string|max:255',
            'sequence' => 'nullable|exists:sequences,id',
        ]);

        $account = Account::create($validatedData);
        return response()->json($account, 201);
    }

    public function show(Account $account)
    {
        return response()->json($account);
    }

    public function update(Request $request, Account $account)
    {
        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'client_id' => 'exists:clients,id',
            'number' => 'string|max:255',
            'sequence' => 'nullable|exists:sequences,id',
        ]);

        $account->update($validatedData);
        return response()->json($account);
    }

    public function destroy(Account $account)
    {
        $account->delete();
        return response()->json(null, 204);
    }
}
