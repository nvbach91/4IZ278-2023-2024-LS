<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sequence extends Model
{
    use HasFactory;

    protected $fillable = ['generator', 'last_used'];

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }
}
