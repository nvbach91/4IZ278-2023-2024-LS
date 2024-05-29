<?php

namespace App\Http\Controllers;

use App\Models\ApiKey;
use App\Models\Generated;
use App\Models\Seller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeneratedController extends Controller
{
    public function index(Request $request, $hash = null)
    {
        if ($hash !== null) {
            // Get generated entries by seller hash
            $seller = Seller::where('hash', $hash)->first();
            if ($seller) {
                $generated = Generated::where('seller_id', $seller->id)->get();
                return response()->json($generated);
            }
            return response()->json(['error' => 'Seller not found'], 404);
        }

        $user = auth()->user();
        if ($user) {
            if ($user->role === 'admin') {
                $generated = Generated::all();
                foreach ($generated as $entry) {
                    $entry->client_id = $entry->seller->client_id;
                }
                return response()->json($generated);
            }
            $clients = $user->clients->pluck('id');
            $generated = Generated::whereIn('seller_id', function ($query) use ($clients) {
                $query->select('id')->from('sellers')->whereIn('client_id', $clients);
            })->get();
            foreach ($generated as $entry) {
                $entry->client_id = $entry->seller->client_id;
            }
            return response()->json($generated);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function showWithHash(Request $request, $hash = null, $id)
    {
        $generated = Generated::find($id);

        if (!$generated) {
            return response()->json(['error' => 'Generated entry not found'], 404);
        }

        $seller = $generated->seller;

        if ($hash && $hash === $seller->hash) {
            // Check payment status
            $this->checkPaymentStatus($generated->account_id);

            return response()->json($generated);
        }

        return response()->json(['error' => 'Unauthorized'], 403);
    }

    protected function checkPaymentStatus($accountId)
    {
        $apiKeys = ApiKey::where('account_id', $accountId)->orderBy('updated_at', 'asc')->get();

        if ($apiKeys->isEmpty()) {
            return;
        }

        $numKeys = $apiKeys->count();
        $optimalInterval = 30 / $numKeys; // Calculate the optimal time interval between key usages

        $eligibleApiKey = null;
        $now = now();

        foreach ($apiKeys as $apiKey) {
            $lastUsed = $apiKey->updated_at ? Carbon::parse($apiKey->updated_at) : Carbon::createFromTimestamp(0);
            if ($lastUsed->diffInSeconds($now) >= 30 || $lastUsed->diffInSeconds($now) >= $optimalInterval) {
                $eligibleApiKey = $apiKey;
                break;
            }
        }

        if (!$eligibleApiKey) {
            return;
        }

        $response = Http::get("https://www.fio.cz/ib_api/rest/last/{$eligibleApiKey->key}/transactions.json");

        if ($response->failed()) {
            return;
        }

        $transactions = $response->json()['accountStatement']['transactionList']['transaction'] ?? [];

        Log::info('Fetched transactions', [
            'account_id' => $accountId,
            'num_transactions' => count($transactions)
        ]);

        $generatedEntries = Generated::where('account_id', $accountId)->get();

        foreach ($generatedEntries as $generated) {
            foreach ($transactions as $transaction) {
                $variableSymbol = $transaction['column5']['value'] ?? null;

                if ($variableSymbol == $generated->variable_symbol) {
                    $generated->success = true;
                    $generated->save();

                    // Log the payment processing
                    Log::info('Payment processed', [
                        'generated_id' => $generated->id,
                        'account_id' => $generated->account_id,
                        'variable_symbol' => $variableSymbol,
                        'transaction_id' => $transaction['column22'],
                        'amount' => $transaction['column1'],
                        'currency' => $transaction['column14'],
                        'date' => $transaction['column0']
                    ]);
                }
            }
        }

        // Update the updated_at timestamp of the eligible ApiKey
        $eligibleApiKey->touch();
    }

    public function show(Request $request, $id)
    {
        $generated = Generated::find($id);

        if (!$generated) {
            return response()->json(['error' => 'Generated entry not found'], 404);
        }

        $seller = $generated->seller;

        $user = auth()->user();
        if ($user && $user->clients->contains($seller->client)) {
            return response()->json($generated);
        }

        return response()->json(['error' => 'Unauthorized'], 403);
    }

    public function store(Request $request, $hash = null)
    {
        $validatedData = $request->validate([
            'amount' => 'required|numeric',
            'variable_symbol' => 'required|string|max:255',
            'seller_hash' => 'nullable|string|exists:sellers,hash',
            'account_id' => 'required|exists:accounts,id',
            'success' => 'boolean',
        ]);

        $validatedData['success'] = $request->input('success', true);

        if ($hash !== null) {
            $seller = Seller::where('hash', $hash)->first();
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
