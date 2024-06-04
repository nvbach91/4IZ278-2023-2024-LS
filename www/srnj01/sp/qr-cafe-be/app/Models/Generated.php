<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Generated extends Model
{
    use HasFactory;

    protected $table = 'generated';

    protected $fillable = ['amount', 'variable_symbol', 'seller_id', 'account_id', 'success'];

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
