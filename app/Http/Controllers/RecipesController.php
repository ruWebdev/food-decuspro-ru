<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class RecipesController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Recipes', [
            'title' => __('Рецепты'),
            'description' => __('Подборка кулинарных рецептов и рекомендаций'),
        ]);
    }

    public function show(string $slug): Response
    {
        return Inertia::render('Recipe', [
            'title' => __('Рецепт'),
            'slug' => $slug,
            'description' => __('Детальная страница рецепта'),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('RecipeCreate', [
            'title' => __('Добавить рецепт'),
            'description' => __('Страница добавления нового рецепта'),
        ]);
    }
}
