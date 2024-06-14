<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'id',
        'display_name',
        'balance'
    ];
    use HasFactory;
    public function sentTransactions()
    {
        return $this->hasMany(Transaction::class, 'from_account');
    }

    public function receivedTransactions()
    {
        return $this->hasMany(Transaction::class, 'target_account');
    }
    public function accountPermissions()
    {
        return $this->hasMany(AccountPermission::class);
    }
    public function getPermissions()
    {
        return $this->accountPermissions()->get();
    }
    public function getTransactions()
    {
        return Transaction::where('from_account', $this->id)
            ->orWhere('target_account', $this->id);
    }
    public function getOwner()
    {
        return $this->accountPermissions()->where('permission', 'owner')->first()->user;
    }
}
