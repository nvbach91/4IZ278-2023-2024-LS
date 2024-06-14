<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = "user";
    protected $fillable = [
        "id",
        "first_name",
        "last_name",
        "birth_date",
        "is_student",
        "email",
        "password",
        "phone",
        "membership",
        "is_admin"
    ];

    public function flights() {
        return $this->hasMany(Ticket::class, 'id', 'passenger_id');
    }
}
