<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class dataBase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $workers = DB::table('workers')->select('name')->distinct()->get()->toArray();
        dd($workers);
    }
}
