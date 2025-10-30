<script setup>
 import { Link } from '@inertiajs/vue3'
 const props = defineProps({
   open: { type: Boolean, default: false }
 })
</script>

<template>
  <div class="col-lg-2 sidebar-left d-lg-block" :class="{ show: props.open }">
    <div class="p-3">
      <!-- Логотип -->
      <div class="d-flex align-items-center mb-4">
        <img src="https://via.placeholder.com/32x32/000/FFF?text=🍊" alt="Logo">
        <span class="logo">{{ __('ЛОГОТИП') }}</span>
      </div>

      <!-- Навигация -->
      <nav class="nav flex-column mb-4">
        <Link :href="route('dashboard')" class="nav-link active"><i class="bi bi-speedometer2"></i> {{ __('Панель') }}</Link>
        <Link href="#" class="nav-link"><i class="bi bi-calendar3"></i> {{ __('Календарь') }}</Link>
        <Link href="#" class="nav-link"><i class="bi bi-chat-dots"></i> {{ __('Сообщения') }} <span class="badge bg-danger ms-1">100</span></Link>
        <Link href="#" class="nav-link"><i class="bi bi-journal-text"></i> {{ __('Полезное меню') }}</Link>
        <Link href="#" class="nav-link"><i class="bi bi-list-check"></i> {{ __('План питания') }}</Link>
        <Link href="#" class="nav-link"><i class="bi bi-book"></i> {{ __('Дневник питания') }}</Link>
        <Link href="#" class="nav-link"><i class="bi bi-graph-up"></i> {{ __('Прогресс') }}</Link>
        <Link href="#" class="nav-link"><i class="bi bi-dumbbell"></i> {{ __('Упражнения') }}</Link>
        <Link href="#" class="nav-link"><i class="bi bi-lightbulb"></i> {{ __('Здоровье') }}</Link>
      </nav>

      <!-- Рекламный блок -->
      <div class="promo-banner mb-4">
        <div class="d-flex justify-content-center mb-3">
          <img src="https://via.placeholder.com/80x80/FFF/000?text=🥗" alt="Promo">
        </div>
        <h5>{{ __('Начните свой путь к здоровью с БЕСПЛАТНЫМ доступом на 1 месяц!') }}</h5>
        <button class="btn btn-light btn-sm mt-2">{{ __('Получить') }}</button>
      </div>

      <!-- Кнопка выхода -->
      <div class="text-center">
        <Link :href="route('logout')" method="post" as="button" class="btn btn-outline-secondary w-100"><i class="bi bi-box-arrow-right"></i> {{ __('Выйти') }}</Link>
      </div>
    </div>
  </div>
</template>
