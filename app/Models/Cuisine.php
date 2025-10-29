<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cuisine extends Model
{
    protected $fillable = ['name', 'slug'];

    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }
}
