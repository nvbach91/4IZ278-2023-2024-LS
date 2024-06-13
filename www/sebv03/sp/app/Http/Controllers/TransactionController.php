<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Account $account)
    {
        $user = Auth::user();
        $accounts = $user->getAccounts();
        if (!$accounts->contains($account)) {
            abort(403);
        }
        $accountPermission = $account->getPermissions()->where('user_id', $user->id)->first();
        if (!$accountPermission || $accountPermission->permission == 'follower') {
            abort(403);
        }
        return view('createTransaction', [
            'account' => $account
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'targetAccount' => 'required|exists:accounts,id',
            'message' => 'nullable|string|max:255'
        ]);
        $user = Auth::user();
        $account = Account::find($request->account);
        $accountPermission = $account->getPermissions()->where('user_id', $user->id)->first();
        if (!$accountPermission || $accountPermission->permission == 'follower') {
            abort(403);
        }
        $this->validate($request, [
            'amount' => 'required|numeric|min:0.01|max:' . $account->balance
        ]);
        $targetAccount = Account::find($request->targetAccount);
        $accoutPermission = $account->getPermissions()->where('user_id', $user->id)->first();
        if (!$accoutPermission || $accoutPermission->permission == 'follower') {
            abort(403);
        }
        $account->balance -= $request->amount;
        $account->save();
        $targetAccount->balance += $request->amount;
        $targetAccount->save();
        $transaction = new Transaction();
        $transaction->from_account = $account->id;
        $transaction->target_account = $request->targetAccount;
        $transaction->amount = $request->amount;
        $transaction->message = $request->message;
        $transaction->sent_by = $user->id;
        $transaction->save();
        return redirect()->route('account.show', ['account' => $account]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
