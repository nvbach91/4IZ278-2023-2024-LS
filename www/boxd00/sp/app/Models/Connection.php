<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function Symfony\Component\String\b;

class Connection extends Model
{
    use HasFactory;

    protected $table = "connection";
    protected $fillable = [
        "flight_code",
        "from_code",
        "to_code",
        "day",
        "time",
        "duration",
        "price"
    ];

    public function flights() {
        return $this->hasMany(Flight::class, 'flight_code', 'flight_code');
    }

    public function from_destination() {
        return $this->belongsTo(Destination::class, "from_code", "airport_code");
    }

    public function to_destination() {
        return $this->belongsTo(Destination::class, "to_code", "airport_code");
    }
}
