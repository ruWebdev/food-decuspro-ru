<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
  <section class="sidebar col-12 col-lg-2">
    <div class="sidebar-blok-up">
      <Link class="logo-link" :href="route('recipes.index')"><img src="/img/Logo.png" alt="logo" /></Link>
      <ul class="sidebar-menu">
        <li>
          <Link :href="route('recipes.index')" class="sidebar-menu-link sidebar-menu-link-1">
            <img class="icon" src="/img/icon-menu.svg" width="22" height="22" alt="Recipes" />Рецепты
          </Link>
        </li>
        <li>
          <Link :href="route('news.index')" class="sidebar-menu-link sidebar-menu-link-2">
            <img class="icon" src="/img/icon-messages.svg" width="22" height="22" alt="News" />Новости
          </Link>
        </li>
        <li>
          <Link :href="route('ratings.index')" class="sidebar-menu-link sidebar-menu-link-7">
            <img class="icon" src="/img/icon-progress.svg" width="22" height="22" alt="Ratings" />Рейтинги
          </Link>
        </li>
        <li>
          <Link :href="route('account.index')" class="sidebar-menu-link sidebar-menu-link-4">
            <img class="icon" src="/img/icon-user.png" width="22" height="22" alt="Account" />Профиль
          </Link>
        </li>
      </ul>
    </div>
    <div class="sidebar-blok-down">
      <div class="sidebar-blok-down-image">
        <img src="/img/cabinet-Image-1.png" alt="menu" />
        <p class="blok-down-image-text-1">Start your health journey with a <b>FREE 1-month</b> access to Nutrigo!</p>
        <p class="blok-down-image-text-2">Claim Now!</p>
      </div>
      <li>
        <Link :href="route('logout')" method="post" as="button" class="sidebar-menu-link sidebar-menu-link-10">
          <img class="icon" src="/img/icon-exit.svg" width="22" height="22" alt="Exit" />Выйти
        </Link>
      </li>
    </div>
  </section>
</template>
