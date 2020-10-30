<?php

return [

    'import' => [
        'types' => [
            'results.all',
            'results.sections',
        ],
    ],

    'urls' => [
        'results' => [
            'all' => [
                'template' => 'https://racing.hkjc.com/racing/information/{?}/Racing/ResultsAll.aspx?RaceDate={?}',
                'language' => 'chinese',
                'format' => 'Y/m/d',
            ],
            'sections' => [
                'template' => 'https://racing.hkjc.com/racing/information/{?}/Racing/DisplaySectionalTime.aspx?RaceDate={?}&All=True',
                'language' => 'chinese',
                'format' => 'd/m/Y',
            ],
        ],
        'node' => env('URLS_NODE', '/usr/local/bin/node'),
        'npm' => env('URLS_NPM', '/usr/local/bin/npm'),
        'delay' => env('URLS_DELAY', 10000),
        'strict' => env('URLS_STRICT', false),
    ],

];
