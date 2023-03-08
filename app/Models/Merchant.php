<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Merchant extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Filterable;
    use InteractsWithMedia;

    public function terminals(): MorphMany
    {
        return $this->morphMany(Terminal::class, 'terminalable');
    }

}
