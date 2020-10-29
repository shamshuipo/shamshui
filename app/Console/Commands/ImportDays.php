<?php

namespace App\Console\Commands;

use App\Models\Day;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;

class ImportDays extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:days {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import racing days';

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
        $count = 0;

        try
        {
            $lines = File::lines($this->argument('file'));
            foreach($lines as $line) {
                $fields = explode("\t", $line);
                if (count($fields) >= 6) {
                    $day = Day::firstOrCreate([
                        'code' => $fields[0],
                        'location' => $fields[1],
                    ]);
                    $day->update([
                        'name' => $fields[5],
                        'daynight' => $fields[2],
                        'date' => Carbon::createFromFormat('Y-m-d', $fields[0]),
                    ]);
                    $count += 1;
                } 
            }

            $this->info("Import {$this->argument('file')} with {$count} racing days");
        }
        catch (FileNotFoundException $exception)
        {
            $this->error("{$this->argument('file')} not found");
        }

        return $count;
    }
}
