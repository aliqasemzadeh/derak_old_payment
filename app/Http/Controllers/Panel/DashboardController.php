<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function chart()
    {
        $collection = collect([1,5,6,4,6,6,4,4,2,5,4,2,3,5,2,5,4,2,7,3,1,1,1,4,7,4,4,4,4,8,8,5,1]);
        $random = $collection->random(30);
        $data  = $random->all();
        return response()->json(['payments' => $data, 'labels' => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30]]);
    }
}
