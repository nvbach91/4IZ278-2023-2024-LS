<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiKey extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'account_id'];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
