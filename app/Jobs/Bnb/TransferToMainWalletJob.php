<?php

namespace App\Jobs\Bnb;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TransferToMainWalletJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $address;
    public $contact;

    /**
     * Create a new job instance.
     */
    public function __construct($address, $contract = null)
    {
        $this->address = $address;
        $this->contract = $contract;;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if($this->contact) {

        } else {

        }
    }
}
