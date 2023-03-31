<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserVerify extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Filterable;

    protected $fillable = [
        'user_id',
    ];

    public function next(){
        return UserVerify::whereIn('status', ['wait'])->where('updated_at', '>', $this->updated_at)->orderBy('updated_at', 'ASC')->first();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
