<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateRatesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:rates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update rates.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Command::SUCCESS;
    }
}
