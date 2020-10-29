<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'code',
        'name',
        'info',
        'state',
    ];

    protected $casts = [
        'meta' => 'json',
        'info' => 'json',
    ];
}
