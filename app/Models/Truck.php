<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    use HasFactory;

    protected $fillabel = ['TruckID', 'Goods', 'Destination', 'Lat', 'Long', 'Next Destination'];
}
