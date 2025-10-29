<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeStep extends Model
{
    protected $fillable = ['recipe_id', 'position', 'body', 'photo_path'];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
