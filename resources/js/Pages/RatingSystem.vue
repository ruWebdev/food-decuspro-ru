<script setup>
import { Head } from '@inertiajs/vue3';
import LKSecondaryLayout from '@/Layouts/LKSecondaryLayout.vue';

const props = defineProps({
  title: { type: String, required: true },
  description: { type: String, required: false },
});
</script>

<template>
  <LKSecondaryLayout>
    <Head :title="props.title" />

    <section class="section-cabinet">
      <section class="section-title">
        <h1 class="h1 h1-vhod h1-lk">{{ props.title }}</h1>
      </section>

      <section class="section-title-2">
        <p class="section-title-2-text">{{ __('Общая информация') }}</p>
      </section>

      <section class="section-reiting">
        <div class="reiting-card">
          <h3 class="h3">{{ __('Ваш текущий рейтинг') }}</h3>
          <p class="reiting-value">{{ __('Скоро появится информация о рейтингах') }}</p>
        </div>
        <div class="reiting-card">
          <h3 class="h3">{{ __('Прогресс достижений') }}</h3>
          <p class="reiting-desc">{{ __('Мы готовим описание алгоритмов и визуализацию прогресса пользователей.') }}</p>
        </div>
      </section>
    </section>
  </LKSecondaryLayout>
</template>
