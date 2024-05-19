<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'client_id', 'number', 'sequence'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function sequence()
    {
        return $this->belongsTo(Sequence::class);
    }

    public function apiKeys()
    {
        return $this->hasMany(ApiKey::class);
    }

    public function generated()
    {
        return $this->hasMany(Generated::class);
    }
}
