<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
  email: '',
  mobile_phone: '',
  password: '',
});

function submit() {
  form.post(route('login'), {
    onFinish: () => form.reset('password'),
  });
}
</script>

<template>
  <Head title="Авторизация">
    <link rel="stylesheet" href="/fonts/stylesheet.css">
    <link rel="stylesheet" href="/css/main.css">
  </Head>

  <section class="section-registration">
    <div class="section-registration-content">
      <div class="section-registration-content-col section-registration-content-col-1">
        <img src="/img/image-2.jpg" alt="registration">
      </div>
      <div class="section-registration-content-col section-registration-content-col-2">
        <h1 class="h1 h1-vhod">Авторизация</h1>
        <form class="form-registration" @submit.prevent="submit">
          <div class="form-ryad form-ryad-1 form-ryad-2">
            <div class="form-ryad-1-col form-ryad-1-col-3">
              <p class="text-label-form">Ваш логин</p>
              <input class="pole pole-1 pole-1-1" type="email" v-model="form.email" placeholder="Введите свой логин" required>
            </div>
          </div>
          <div class="form-ryad form-ryad-1 form-ryad-2">
            <div class="form-ryad-1-col form-ryad-1-col-3">
              <p class="text-label-form">Мобильный телефон</p>
              <input class="pole pole-1 pole-1-4" type="tel" v-model="form.mobile_phone" placeholder="Введите свой телефон">
            </div>
          </div>
          <div class="form-ryad form-ryad-1 form-ryad-2">
            <div class="form-ryad-1-col form-ryad-1-col-3">
              <p class="text-label-form">Пароль</p>
              <input class="pole pole-1 pole-1-3" type="password" v-model="form.password" placeholder="Введите свой пароль" required autocomplete="current-password">
            </div>
          </div>
          <div class="form-ryad form-ryad-1 form-ryad-2 form-ryad-4">
            <button class="button-1 button-2" type="submit">Войти</button>
          </div>
          <div class="form-ryad form-ryad-1 form-ryad-2  form-ryad-5">
            <div class="form-ryad-1-col form-ryad-1-col-3">
              <p class="text-label-form text-label-form-5">Зарегистрироваться с помощью </p>
              <Link :href="route('auth.vk.redirect')"><img src="/img/icon-vk.png" alt="vk"></Link>
            </div>
          </div>
        </form>
        <div class="form-ryad form-ryad-1 form-ryad-2 form-ryad-5 form-ryad-6">
          <p class="text-label-form text-label-form-5">Нет аккаунта?</p>
          <Link class="text-label-form text-label-form-5 link-6" :href="route('register')">Зарегистрироваться</Link>
        </div>
      </div>
    </div>
  </section>

  <footer></footer>
</template>
