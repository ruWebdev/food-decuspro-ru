<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
  canLogin: {
    type: Boolean,
  },
  canRegister: {
    type: Boolean,
  },
});
</script>

<template>
  <Head title="Добро пожаловать">
    <link rel="stylesheet" href="/fonts/stylesheet.css">
    <link rel="stylesheet" href="/css/main.css">
  </Head>

  <div class="welcome-page">
    <section class="section-one">
      <div class="section-one-content">
        <div class="section-one-left"></div>
        <div class="section-one-right">
          <h1 class="h1 h1-vhod">Добро пожаловать<br> на “Название портала”!</h1>
          <p class="description">Поместить стейки в пластиковый пакет с застёжкой, добавить 3 ст. л. оливкового масла, 1 ч. л. белого винного уксуса, 1/2 ч. л.</p>

          <div class="section-one-blok-button">
            <div class="section-one-blok-button-col section-one-blok-button-col-1">
              <p>У меня есть учётная запись</p>
              <Link :href="route('login')" class="button-1">Войти</Link>
            </div>
            <div class="section-one-blok-button-col section-one-blok-button-col-2">
              <p>У меня нет учётной записи</p>
              <Link v-if="canRegister" :href="route('register')" class="button-1 button-2">Зарегистрироваться</Link>
            </div>
          </div>
        </div>
      </div>
    </section>

    <footer></footer>
  </div>
</template>
