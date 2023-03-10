<?php

namespace App\Observers;

use App\Models\Transaction;
use App\Models\Wallet;

class WalletTransactionObserver
{
    /**
     * Handle the Transaction "created" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function created(Transaction $transaction)
    {
        $wallet = Wallet::find($transaction->wallet_id);
        $wallet->balance = round(Transaction::where('wallet_id', $transaction->wallet_id)->sum('amount'), 8, PHP_ROUND_HALF_DOWN);
        $wallet->save();
    }

    /**
     * Handle the Transaction "updated" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function updated(Transaction $transaction)
    {
        $wallet = Wallet::find($transaction->wallet_id);
        $wallet->balance = round(Transaction::where('wallet_id', $transaction->wallet_id)->sum('amount'), 8, PHP_ROUND_HALF_DOWN);
        $wallet->save();
    }

    /**
     * Handle the Transaction "deleted" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function deleted(Transaction $transaction)
    {
        $wallet = Wallet::find($transaction->wallet_id);
        $wallet->balance = round(Transaction::where('wallet_id', $transaction->wallet_id)->sum('amount'), 8, PHP_ROUND_HALF_DOWN);
        $wallet->save();
    }

    /**
     * Handle the Transaction "restored" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function restored(Transaction $transaction)
    {
        $wallet = Wallet::find($transaction->wallet_id);
        $wallet->balance = round(Transaction::where('wallet_id', $transaction->wallet_id)->sum('amount'), 8, PHP_ROUND_HALF_DOWN);
        $wallet->save();
    }

    /**
     * Handle the Transaction "force deleted" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function forceDeleted(Transaction $transaction)
    {
        $wallet = Wallet::find($transaction->wallet_id);
        $wallet->balance = round(Transaction::where('wallet_id', $transaction->wallet_id)->sum('amount'), 8, PHP_ROUND_HALF_DOWN);
        $wallet->save();
    }
}
