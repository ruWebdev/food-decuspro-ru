<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  image: { type: String, required: true },
  title: { type: String, required: true },
  href: { type: [String, Object], default: '#' },
  category: { type: String, default: '' },
  categoryClass: { type: String, default: 'category-bluda-1' },
  difficulty: { type: String, default: '' },
  rating: { type: Number, default: null },
  kcal: { type: String, default: '' },
  carbs: { type: String, default: '' },
  protein: { type: String, default: '' },
  fat: { type: String, default: '' },
});
</script>

<template>
  <div class="katalog-item">
    <div class="katalog-item-image">
      <img :src="image" alt="bludo" />
    </div>
    <div class="katalog-item-info">
      <div class="katalog-item-info-up d-flex justify-content-between">
        <div class="katalog-item-blok-category">
          <p class="category-bluda" :class="categoryClass">{{ __(category) }}</p>
          <p v-if="difficulty" class="slognost-bluda">{{ __(difficulty) }}</p>
        </div>
        <div v-if="rating" class="reiting-bluda d-none d-lg-flex align-items-center">
          <p class="reiting-bluda-text">{{ __('Оценка:') }}</p>
          <p class="reiting-bluda-text reiting-bluda-bal"><span>{{ rating }}</span> / 5</p>
        </div>
      </div>
      <div class="katalog-item-info-center">
        <Link :href="href">
          <h2 class="h2 h2-katalog">{{ title }}</h2>
        </Link>
      </div>
      <div class="katalog-item-info-down d-flex align-items-center justify-content-between flex-wrap gap-2">
        <div class="sostav-bluda-blok d-flex align-items-center gap-3">
          <div v-if="kcal" class="sostav-bluda-element">
            <img src="/img/icon-kkal.png" alt="sostav">
            <p class="sostav-bluda-text">{{ kcal }}</p>
          </div>
          <div v-if="carbs" class="sostav-bluda-element">
            <img src="/img/icon-uglevod.png" alt="sostav">
            <p class="sostav-bluda-text">{{ carbs }}</p>
          </div>
          <div v-if="protein" class="sostav-bluda-element">
            <img src="/img/icon-belok.png" alt="sostav">
            <p class="sostav-bluda-text">{{ protein }}</p>
          </div>
          <div v-if="fat" class="sostav-bluda-element">
            <img src="/img/icon-giri.png" alt="sostav">
            <p class="sostav-bluda-text">{{ fat }}</p>
          </div>
        </div>
        <slot name="actions">
          <Link class="button-1 button-lk-3 button-recepty-2" :href="href">{{ __('Готовить') }}</Link>
        </slot>
      </div>
    </div>
    <div class="katalog-item-down">
      <div class="katalog-item-down-1"></div>
      <div class="katalog-item-down-2"></div>
    </div>
  </div>
</template>
