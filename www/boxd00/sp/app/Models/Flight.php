<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function Symfony\Component\String\b;

class Flight extends Model
{
    use HasFactory;

    protected $table = "flight";
    protected $fillable = [
        "id",
        "flight_code",
        "delay",
        "date"
    ];

    public function connection() {
        return $this->belongsTo(Connection::class, 'flight_code', 'flight_code');
    }

    public function tickets() {
        return $this->hasMany(Ticket::class, "flight_id", "id");
    }
}
