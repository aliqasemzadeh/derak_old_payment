<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * @bodyParam symbol string required
     * @bodyParam network string required
     */

    /**
     * @response 200 string address
     */
    public function getAddress($symbol, $network)
    {
        $networkClass = config('networks.'.$network.'.class');
        $networkAddress = $networkClass::getAddress($symbol);
        $networkAddress->save();

        return $networkAddress->address;
    }
}
