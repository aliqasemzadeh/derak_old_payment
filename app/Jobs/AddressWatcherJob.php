<?php

namespace App\Jobs;

use App\Models\Address;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class AddressWatcherJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $address_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($address_id)
    {
        $this->address_id = $address_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $address = Address::withExpired()->findOrFail($this->address_id);
        $networkClass = config('networks.'.$address->network.'.class');
        $this->networkAddress = $networkClass::updateAddressBalance($address);
    }
}
