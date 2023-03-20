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

class AddressWatcherJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Address $address;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($address)
    {
        $this->address = Address::withTrashed()->findOrFail($address);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $networkClass = config('networks.'.$this->address->network.'.class');
        $this->networkAddress = $networkClass::updateAddressBalance($this->address);
    }
}
