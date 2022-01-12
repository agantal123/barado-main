<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reusedwater extends Model
{
    //
    protected $table = 'reused_water';
    protected $fillable = [
        'water_id', 'amount','created_at', 'updated_at'
    ];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y', 
        'updated_at' => 'datetime:d/m/Y',
    ];
    
}
