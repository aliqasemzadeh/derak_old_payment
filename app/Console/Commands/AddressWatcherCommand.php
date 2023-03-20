<?php

namespace App\Console\Commands;

use App\Jobs\AddressWatcherJob;
use App\Models\Address;
use Illuminate\Console\Command;

class AddressWatcherCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'watch:addresses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will check balance of active address.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $addresses = Address::all();
        foreach ($addresses as $address) {
            AddressWatcherJob::dispatch($address->id);
        }
        return Command::SUCCESS;
    }
}
