<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaradoSensor extends Model
{
    use HasFactory;
    protected $table = 'barado_sensors';

    protected $fillable = [
        'weight','distance', 'trap_id'
    ];
}
