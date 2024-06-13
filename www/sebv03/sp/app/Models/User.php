<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    public function AccountPermissions()
    {
        return $this->hasMany(AccountPermission::class);
    }
    public function Transactions()
    {
        return $this->hasMany(Transaction::class);
    }
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

    public function getAccountPermissions() : Collection
    {
        return AccountPermission::where('user_id', $this->id)->get();
    }
    public function getAccounts(): Collection
    {
        $accountPermissions = $this->getAccountPermissions();
        $accounts = [];
        foreach ($accountPermissions as $accountPermission) {
            $accounts[] = Account::find($accountPermission->account_id);
        }
        return collect($accounts);
    }
}
