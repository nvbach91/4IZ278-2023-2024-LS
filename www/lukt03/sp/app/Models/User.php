<?php

namespace App\Models;

use App\Events\UserDeleted;
use App\Events\UserUpdating;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'location',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * The event map for the model.
     * 
     * @var array
     */
    protected $dispatchesEvents = [
        'updating' => UserUpdating::class,
        'deleted' => UserDeleted::class,
    ];

    public function avatarUrl(): Attribute
    {
        return Attribute::get(
            fn () => isset($this->avatar_path) ? Storage::url($this->avatar_path) : null
        );
    }

    public function avatarUrlWithPlaceholder(): Attribute
    {
        return Attribute::get(
            fn () => Storage::url($this->avatar_path ?? 'public/avatars/placeholder.png')
        );
    }

    public function isSitter(): bool
    {
        return $this->role === 1;
    }

    public function isAdmin(): bool
    {
        return $this->role === 2;
    }

    public function isHidden(): bool
    {
        return !$this->isSitter();
    }

    public function cats(): HasMany
    {
        return $this->hasMany(Cat::class, 'owner_id');
    }

    public function availableTimes(): HasMany
    {
        return $this->hasMany(AvailableTime::class, 'sitter_id');
    }

    public function sittingsAsOwner(): HasMany
    {
        return $this->hasMany(Sitting::class, 'owner_id');
    }

    public function sittingsAsSitter(): HasMany
    {
        return $this->hasMany(Sitting::class, 'sitter_id');
    }

    public function reviewsAsOwner(): HasManyThrough
    {
        return $this->through('sittingsAsOwner')->has('review');
    }

    public function reviewsAsSitter(): HasManyThrough
    {
        return $this->through('sittingsAsSitter')->has('review');
    }
}
