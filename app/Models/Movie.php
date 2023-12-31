<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Nova\Actions\Actionable;

class Movie extends Model
{
    use HasFactory;
    use Actionable;

    protected $with = [
        'genre',
        'subgenre',
    ];

    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }

    public function subgenre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }

    public function director(): BelongsTo
    {
        return $this->belongsTo(Director::class);
    }

    public function studio(): BelongsTo
    {
        return $this->belongsTo(Studio::class);
    }
}
