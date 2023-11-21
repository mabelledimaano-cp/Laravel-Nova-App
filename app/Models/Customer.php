<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Actions\Actionable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;
    use Actionable;

    public function rentals(): HasMany
    {
        return $this->hasMany(Rental::class);
    }

    protected $appends = [
        'name'
    ];

    public function getNameAttribute() {
        return ($this->middle_name ? $this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name : $this->first_name . ' ' . $this->last_name);
    }
}
