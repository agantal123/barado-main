<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sensordata extends Model
{
    use HasFactory;
    protected $table = 'sensor_data';
    protected $fillable = [
        'id', 'water_level_value','loadcell_value'
    ];
}
