<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Nova\Actions\Actionable;

class Studio extends Model
{
    use HasFactory;
    use Actionable;

    public function movies(): HasMany
    {
        return $this->hasMany(Movie::class);
    }
}
