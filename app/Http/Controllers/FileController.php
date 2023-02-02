<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function merchantLogo(Merchant $merchant)
    {
        return Storage::download($merchant->logo);
    }
}
