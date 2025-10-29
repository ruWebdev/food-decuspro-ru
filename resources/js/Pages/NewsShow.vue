<script setup>
import { Head, Link } from '@inertiajs/vue3';
import LKSecondaryLayout from '@/Layouts/LKSecondaryLayout.vue';

const props = defineProps({
  title: { type: String, required: false, default: 'Новость' },
  slug: { type: String, required: true },
  description: { type: String, required: false },
});
</script>

<template>
  <LKSecondaryLayout>
    <Head :title="props.title || __('Новость')" />

    <section class="section-cabinet">
      <section class="section-title">
        <h1 class="h1 h1-vhod h1-lk">{{ props.title || __('Новость') }}</h1>
        <div class="section-title-right">
          <Link :href="route('news.index')" class="button-1 button-lk-3">{{ __('К новостям') }}</Link>
        </div>
      </section>

      <section class="section-title-2">
        <p class="section-title-2-text">{{ __('Детали новости') }}</p>
      </section>

      <section class="news-detail">
        <div class="news-detail-image">
          <img src="/img/new-image-1.jpg" alt="news" />
        </div>
        <div class="news-detail-info">
          <h2 class="h2 h2-katalog">{{ __('Заголовок новости') }}</h2>
          <p class="new-text-data">25 сентября 2025</p>
          <p class="new-text">
            {{ __('Контент новости согласно макету lk-new.html будет перенесен сюда и разбит на компоненты.') }}
          </p>
        </div>
      </section>
    </section>
  </LKSecondaryLayout>
</template>
