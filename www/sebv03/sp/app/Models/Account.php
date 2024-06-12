<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
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

}
