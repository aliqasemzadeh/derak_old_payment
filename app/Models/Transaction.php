<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Filterable;
    use LogsActivity;

    protected $fillable = ['type','linker_id','wallet_id'];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class)->withTrashed();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['amount']);
        // Chain fluent methods for configuration options
    }
}
