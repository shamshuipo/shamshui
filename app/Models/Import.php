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
        'html',
        'data',
        'meta',
        'info',
        'state',
    ];

    protected $casts = [
        'data' => 'json',
        'meta' => 'json',
        'info' => 'json',
    ];

    public function importable()
    {
        return $this->morphTo();
    }
}
