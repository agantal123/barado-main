<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class graywatertank extends Model
{
    use HasFactory;
    protected $table = 'graywater';
    protected $fillable = [
        'id', 'graywater_amount','created_at', 'updated_at'
    ];
}
