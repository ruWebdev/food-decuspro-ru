<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DietaryRestriction extends Model
{
    protected $fillable = ['name', 'slug'];

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class)
            ->withTimestamps();
    }
}
