<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserWallet extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Filterable;

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed()->withDefault([
            'name' => __('bap.Bad Name'),
        ]);;;
    }
}
