<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory, HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name', 'supertype', 'type', 'subtype', 'hp', 'set_id', 'image_small_url', 'image_large_url'
    ];

    public function cardSet()
    {
        return $this->belongsTo(CardSet::class, 'set_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_cards')->withPivot('count');
    }

    public function decks()
    {
        return $this->belongsToMany(Deck::class, 'decks_cards')->withPivot('count');
    }
}
