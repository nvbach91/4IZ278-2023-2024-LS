<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'hash', 'active', 'client_id'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function generated()
    {
        return $this->hasMany(Generated::class);
    }
}
