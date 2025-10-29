<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\RecipesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('recipes.index');
    }
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register')
    ]);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/recipes', [RecipesController::class, 'index'])->name('recipes.index');
    Route::get('/recipes/create', [RecipesController::class, 'create'])->name('recipes.create');
    Route::get('/recipes/{slug}', [RecipesController::class, 'show'])->name('recipes.show');
    Route::get('/news', [PageController::class, 'news'])->name('news.index');
    Route::get('/news/{slug}', [PageController::class, 'newsShow'])->name('news.show');
    Route::get('/ratings', [PageController::class, 'ratingSystem'])->name('ratings.index');
    Route::get('/account', [PageController::class, 'account'])->name('account.index');
    Route::get('/settings', [PageController::class, 'settings'])->name('settings.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
