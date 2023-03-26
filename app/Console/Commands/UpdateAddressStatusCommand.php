<?php

namespace App\Console\Commands;

use App\Models\Address;
use Illuminate\Console\Command;

class UpdateAddressStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'address:update_status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $addresses = Address::onlyExpired()->where('status', '!=', 'used')->get();
        foreach ($addresses as $address) {
            $address->status = 'expired';
            $address->save();
        }
        return Command::SUCCESS;
    }
}
