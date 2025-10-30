<script setup>
import { Head, Link } from '@inertiajs/vue3';
import LKSecondaryLayout from '@/Layouts/LKSecondaryLayout.vue';

const props = defineProps({
  title: { type: String, required: false, default: 'Добавить рецепт' },
});
</script>

<template>
  <LKSecondaryLayout>
    <Head :title="props.title" />

    <section class="section-cabinet">
      <section class="section-title">
        <h1 class="h1 h1-vhod h1-lk">{{ __('Добавить рецепт') }}</h1>
        <div class="section-title-right">
          <Link :href="route('recipes.index')" class="button-1 button-lk-3">{{ __('К списку рецептов') }}</Link>
        </div>
      </section>

      <section class="section-title-2">
        <p class="section-title-2-text">{{ __('Форма рецепта') }}</p>
      </section>

      <section class="recept-create">
        <!-- Здесь адаптирована структура из lk-dobav-recept.html как заглушка -->
        <form class="recept-form">
          <div class="mb-3">
            <label class="form-label">{{ __('Название рецепта') }}</label>
            <input type="text" class="form-control" placeholder="Например: Тост с авокадо и яйцом" />
          </div>
          <div class="mb-3">
            <label class="form-label">{{ __('Категория') }}</label>
            <select class="form-select">
              <option>{{ __('Завтрак') }}</option>
              <option>{{ __('Обед') }}</option>
              <option>{{ __('Полдник') }}</option>
              <option>{{ __('Ужин') }}</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">{{ __('Описание') }}</label>
            <textarea rows="4" class="form-control" placeholder="..."></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">{{ __('Изображение') }}</label>
            <input type="file" class="form-control" />
          </div>
          <div class="d-flex gap-2">
            <button type="button" class="button-1 button-lk-3">{{ __('Сохранить') }}</button>
            <Link :href="route('recipes.index')" class="button-1 button-lk-5">{{ __('Отмена') }}</Link>
          </div>
        </form>
      </section>
    </section>
  </LKSecondaryLayout>
</template>
