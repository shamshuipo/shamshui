<?php

namespace App\Console\Commands;

use App\Models\Day;
use DiDom\Document;
use DOMDocument;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class UpdateResults extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:results {date}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update results of a racing day YYYY-MM-DD';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = [];
        $date = $this->argument('date');
        $this->info("Update results of {$date}");

        $day = Day::where('code', $date)->firstOrFail();
        $import = $day->imports()->where('type', 'results.all')->firstOrFail();
        $document = new Document($import->html);
        $result = $document->find('.race_result')[0];
        $tables = $result->find('table');

        $count = 0;
        $names = ['places', 'dividend'];
        foreach ($tables as $table) {
            $odd = $count % 2;
            $row = intdiv($count, 2);
            $race = 'Race' . ($row + 1);
            $xml = simplexml_load_string($table->xml());
            $json = json_encode($xml);
            $array = json_decode($json, TRUE);
            $data[$race][$names[$odd]] = $array;
            $count += 1;
        }

        $import->update([
            'meta' => $data,
        ]);

        return $data;
    }
}
