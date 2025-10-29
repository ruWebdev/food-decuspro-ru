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
        <p class="section-title-2-text">{{ __('Профиль пользователя') }}</p>
      </section>

      <section class="lk-profile">
        <div class="lk-blok-user">
          <img class="image-user" src="/img/cabinet-Image-2.png" alt="user" />
          <div class="lk-blok-text">
            <p class="lk-name">{{ __('Имя пользователя') }}</p>
            <p class="lk-status">{{ __('Статус') }}</p>
          </div>
        </div>

        <div class="lk-profile-cards">
          <div class="lk-profile-card">
            <h3 class="h3">{{ __('Личная информация') }}</h3>
            <p class="lk-profile-text">{{ __('Скоро здесь появятся ваши персональные данные и настройки из lk-profil.html') }}</p>
          </div>
          <div class="lk-profile-card">
            <h3 class="h3">{{ __('Активность') }}</h3>
            <p class="lk-profile-text">{{ __('История рецептов, достижения и другая активность пользователя') }}</p>
          </div>
        </div>
      </section>
    </section>
  </LKSecondaryLayout>
</template>
