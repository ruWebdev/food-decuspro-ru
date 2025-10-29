<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'photo_path',
        'video_url',
        'description',
        'servings',
        'difficulty',
        'cuisine_id',
        'active_time',
        'total_time',
        'calories',
    ];

    protected $casts = [
        'servings' => 'integer',
        'active_time' => 'integer',
        'total_time' => 'integer',
        'calories' => 'integer',
    ];

    public function cuisine()
    {
        return $this->belongsTo(Cuisine::class);
    }

    public function steps()
    {
        return $this->hasMany(RecipeStep::class)->orderBy('position');
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class)
            ->withPivot(['quantity', 'unit'])
            ->withTimestamps();
    }

    public function dietaryRestrictions()
    {
        return $this->belongsToMany(DietaryRestriction::class)
            ->withTimestamps();
    }
}
