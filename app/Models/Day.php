<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'code',
        'name',
        'location',
        'daynight',
        'date',
        'info',
        'state',
    ];

    protected $casts = [
        'meta' => 'json',
        'info' => 'json',
    ];

    protected $dates = [
        'date' => 'date:Y-m-d',
    ];
}
