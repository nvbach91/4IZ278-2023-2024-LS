<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    // Define the table if it's not the plural form of the model name
    protected $table = 'destination';

    // Specify which attributes are mass assignable
    protected $fillable = ['airport_code', 'name', 'country'];
}
