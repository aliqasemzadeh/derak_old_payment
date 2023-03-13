<?php

namespace App\Models;

use ALajusticia\Expirable\Traits\Expirable;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Address extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Filterable;
    use Expirable;

    protected $fillable = [
        'address',
        'network',
    ];

    public function scopeUnused(Builder $query): void
    {
        $query->where('status', 'unused');
    }

    public function scopeUsed(Builder $query): void
    {
        $query->where('status', '==', 'used');
    }

    public function scopeOfNetwork(Builder $query, $network): void
    {
        $query->where('network', $network);
    }
}
