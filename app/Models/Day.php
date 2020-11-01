<?php

namespace App\Models;

use App\Services\HkjcService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
        'meta',
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

    public function imports()
    {
        return $this->morphMany(Import::class, 'importable');
    }

    /**
     * $ymd = '2020-10-28';
     * $day = App\Models\Day::where('code', $ymd)->first();
     * $import = $day->import('results.all');
     *
     * @return string
     */
    public function import($type)
    {
        if (empty(config('shamshui.urls.'.$type))) {
            return null;
        }

        $import = $this->imports()->firstOrNew([
            'type' => $type,
            'code' => $this->code,
        ]);

        $html = HkjcService::getHtml($this->code, $type);
        if (Str::contains($html, 'racing')) {
            $import->html = $html;
            $import->save();
        }

        return $import;
    }

    public function results()
    {
        $day = $this;
        $import = $day->imports()->where('type', 'results.all')->first();


        $results = $import->html;

        return $results;
    }
}
