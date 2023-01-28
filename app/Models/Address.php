<?php

namespace App\Models;

use ALajusticia\Expirable\Traits\Expirable;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
