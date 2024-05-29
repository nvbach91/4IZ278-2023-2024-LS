<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Seller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index(Request $request, $hash = null)
    {
        if ($hash !== null) {
            $seller = Seller::where('hash', $hash)->first();
            if ($seller) {
                $accounts = Account::where('client_id', $seller->client->id)->get();
                return response()->json($accounts);
            }
            return response()->json(['error' => 'Seller not found'], 404);
        }

        $user = auth()->user();
        if ($user) {
            $clients = $user->clients->pluck('id');
            $accounts = Account::whereIn('client_id', $clients)->get();
            return response()->json($accounts);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
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
