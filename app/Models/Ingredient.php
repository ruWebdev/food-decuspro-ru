<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable = ['name', 'icon_path'];

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class)
            ->withPivot(['quantity', 'unit'])
            ->withTimestamps();
    }
}
