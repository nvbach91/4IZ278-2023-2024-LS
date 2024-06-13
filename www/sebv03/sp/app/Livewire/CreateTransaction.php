<?php

namespace App\Livewire;

use App\Models\Account;
use Illuminate\Support\Collection;
use Livewire\Component;

class CreateTransaction extends Component
{
    public Account $account;
    public Collection $allAccounts;
    public $displayBalance;
    public $transactionAmount;

    public function mount(Account $account)
    {
        $this->account = $account;
        $this->allAccounts = Account::all()->except($account->id);
        $this->displayBalance = $account->balance;
    }
    public function render()
    {
        return view('livewire.create-transaction');
    }
    public function amountChanged()
    {
        $this->validate([
            'transactionAmount' => 'required|numeric|min:0.01|max:' . $this->account->balance . '|min:0.01'
        ]);
        $this->displayBalance = $this->account->balance - $this->transactionAmount;
    }
}
