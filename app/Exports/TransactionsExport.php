<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;

class TransactionsExport implements FromCollection
{
    public $transactions = [];

    public function __construct($transactions)
    {
        $this->transactions = $transactions;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Transaction::select(['id','type','amount', 'created_at'])->whereIn('id', $this->transactions)->get();
    }
}
