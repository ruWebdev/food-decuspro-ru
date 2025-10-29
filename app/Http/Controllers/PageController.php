<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class PageController extends Controller
{
    public function news(): Response
    {
        return Inertia::render('News', [
            'title' => __('Новости'),
            'description' => __('Актуальные новости и обновления проекта'),
        ]);
    }

    public function ratingSystem(): Response
    {
        return Inertia::render('RatingSystem', [
            'title' => __('Система рейтингов'),
            'description' => __('Механика оценки пользователей и контента'),
        ]);
    }

    public function account(): Response
    {
        return Inertia::render('Account', [
            'title' => __('Личный кабинет'),
            'description' => __('Персональные данные и активность пользователя'),
        ]);
    }

    public function settings(): Response
    {
        return Inertia::render('Settings', [
            'title' => __('Настройки'),
            'description' => __('Управление предпочтениями и конфиденциальностью'),
        ]);
    }

    public function newsShow(string $slug): Response
    {
        return Inertia::render('NewsShow', [
            'title' => __('Новость'),
            'slug' => $slug,
            'description' => __('Детальная страница новости'),
        ]);
    }
}
