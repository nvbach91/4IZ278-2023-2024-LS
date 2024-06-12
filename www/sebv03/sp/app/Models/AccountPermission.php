<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountPermission extends Model
{
    protected $fillable = ['account_id', 'user_id', 'permission'];
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
