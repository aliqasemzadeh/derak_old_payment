<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function storeLogo(Store $store)
    {
        return Storage::download($store->logo);
    }
}
