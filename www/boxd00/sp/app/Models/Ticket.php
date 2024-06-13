<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = "ticket";
    protected $fillable = [
        "id",
        "flight_id",
        "passenger_id",
        "seat",
        "class",
        "reserved",
        "reserved_until"
    ];

    public function flight() {
        return $this->belongsTo(Flight::class, "flight_id", "id");
    }

    public function passenger() {
        return $this->belongsTo(User::class, "passenger_id", "id");
    }
}
