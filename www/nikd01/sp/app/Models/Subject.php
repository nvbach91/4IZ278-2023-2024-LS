<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class);
    }

    public function materials(): HasMany
    {
        return $this->hasMany(Material::class);
    }
}
