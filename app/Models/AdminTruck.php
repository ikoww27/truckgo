<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminTruck extends Model
{
    protected $table = 'admin_trucks';
    
    protected $fillable = [
        'truck_id',
        'goods',
        'destination',
        'lat',
        'long',
        'next_destination'
    ];
}