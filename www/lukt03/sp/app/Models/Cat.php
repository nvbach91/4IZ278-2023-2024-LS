<?php

namespace App\Models;

use App\Events\CatDeleted;
use App\Events\CatUpdating;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class Cat extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'birthday',
        'details',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'birthday' => 'date',
    ];
    
    /**
     * The event map for the model.
     * 
     * @var array
     */
    protected $dispatchesEvents = [
        'updating' => CatUpdating::class,
        'deleted' => CatDeleted::class,
    ];

    public function photoUrl(): Attribute
    {
        return Attribute::get(
            fn () => isset($this->photo_path) ? Storage::url($this->photo_path) : null
        );
    }

    public function photoUrlWithPlaceholder(): Attribute
    {
        return Attribute::get(
            fn () => Storage::url($this->photo_path ?? 'cats/placeholder.png')
        );
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
