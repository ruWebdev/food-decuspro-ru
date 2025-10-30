<script setup>
import { Head, Link } from '@inertiajs/vue3';
import LKPrimaryLayout from '@/Layouts/LKPrimaryLayout.vue';

const props = defineProps({
  title: { type: String, required: true },
  slug: { type: String, required: true },
  description: { type: String, required: false },
});
</script>

<template>
  <LKPrimaryLayout>
    <Head :title="props.title" />

    <section class="section-cabinet">
      <section class="section-title">
        <h1 class="h1 h1-vhod h1-lk">{{ __('Рецепт') }}</h1>
        <div class="section-title-right">
          <Link :href="route('recipes.index')" class="button-1 button-lk-3">{{ __('Назад к рецептам') }}</Link>
        </div>
      </section>

      <section class="section-title-2">
        <p class="section-title-2-text">{{ __('Детали рецепта') }}</p>
      </section>

      <section class="recept-detail">
        <div class="recept-detail-image">
          <img src="/img/recept-image-1.png" alt="recipe" />
        </div>
        <div class="recept-detail-info">
          <h2 class="h2 h2-katalog">{{ __('Тост с авокадо и яйцом') }}</h2>
          <div class="katalog-item-blok-category">
            <p class="category-bluda category-bluda-1">{{ __('Завтрак') }}</p>
            <p class="slognost-bluda">{{ __('Легко') }}</p>
          </div>
          <p class="katalog-item-text">{{ __('Описание рецепта из макета lk-recept.html будет добавлено здесь.') }}</p>
        </div>
      </section>
    </section>
  </LKPrimaryLayout>
</template>
