<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deck extends Model
{
    use HasFactory, HasUuids;

    protected $keyType = 'string';

    protected $fillable = [
        'owner_id', 'name'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function cards()
    {
        return $this->belongsToMany(Card::class, 'decks_cards')->withPivot('count');
    }
}
