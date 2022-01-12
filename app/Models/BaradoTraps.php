<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class BaradoTraps extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'barado_traps';

    protected $fillable = [
        'location','long', 'lat'
    ];
}
