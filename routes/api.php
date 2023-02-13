<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('bitcoin/balance/{address}', [App\Http\Controllers\API\BitcoinController::class, 'balance']);
Route::get('tron/balance-trc20/{address}/{symbol?}', [App\Http\Controllers\API\TronController::class, 'balanceTRC20']);
Route::get('tron/balance-trx/{address}', [App\Http\Controllers\API\TronController::class, 'balanceTRX']);
Route::get('binance/balance-trc20/{address}/{symbol?}', [App\Http\Controllers\API\BinanceController::class, 'balanceBEP20']);
Route::get('binance/balance-trx/{address}', [App\Http\Controllers\API\BinanceController::class, 'balanceBNB']);
