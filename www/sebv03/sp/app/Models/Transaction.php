<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public function fromAccount()
    {
        return $this->belongsTo(Account::class, 'from_account');
    }

    public function targetAccount()
    {
        return $this->belongsTo(Account::class, 'target_account');
    }

    public function sentBy()
    {
        return $this->belongsTo(User::class);
    }

}
