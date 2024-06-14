<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
class AccountController extends Controller
{
    public function index()
    {
        $accounts = Auth::user()->getAccounts();
        return view('dashboard', [
            'accounts' => $accounts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'display_name' => 'required|string|max:255|unique:Account,display_name',

        ]);
        $account = Account::create([
            'display_name' => $request->display_name,
            'balance' => 0
        ]);
        $account->accountPermissions()->create([
            'user_id' => Auth::id(),
            'permission' => 'owner'
        ]);
        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Account $account)
    {
        $user = Auth::user();
        $accounts = $user->getAccounts();
        if (!$accounts->contains($account)) {
            abort(403);
        }
        return view('manageAccount', [
            'account' => $account
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAccountRequest $request, Account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account)
    {
        //
    }
}
