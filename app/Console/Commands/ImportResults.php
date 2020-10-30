<?php

namespace App\Console\Commands;

use App\Models\Day;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class ImportResults extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:results';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import results of a racing day';

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
        foreach (config('shamshui.import.types') as $type)
        {
            $day = Day::whereDate(
                'date', '<=', now(),
            )->whereDoesntHave('imports', function($query) use ($type) {
                $query->where([
                    'type' => $type,
                ]);
            })->orderBy('code')->first();

            if ($day) {
                $this->info("Import {$day->code} {$type}");
                optional($day)->import($type);
            } else {
                $this->info("Import nothing");
            }
        }

        return 0;
    }
}
