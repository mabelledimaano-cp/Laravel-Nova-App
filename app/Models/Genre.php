<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Genre extends Model
{
    use HasFactory;

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Genre::class, 'parent_id');
    }

    public function subGenres(): HasMany
    {
        return $this->hasMany(Genre::class, 'parent_id');
    }

    public function movies(): HasMany
    {
        return $this->hasMany(Movie::class, 'subgenre_id', 'id')->orWhere('genre_id', $this->id);
    }
}
