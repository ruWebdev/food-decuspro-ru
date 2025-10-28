<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
  mobile_phone: '',
  location: '',
});

function submit() {
  form.post(route('register'), {
    onFinish: () => form.reset('password', 'password_confirmation'),
  });
}
</script>

<template>
  <Head title="Регистрация">
    <link rel="stylesheet" href="/fonts/stylesheet.css">
    <link rel="stylesheet" href="/css/main.css">
  </Head>

  <section class="section-registration">
    <div class="section-registration-content">
      <div class="section-registration-content-col section-registration-content-col-1">
        <img src="/img/image-2.jpg" alt="registration">
      </div>
      <div class="section-registration-content-col section-registration-content-col-2">
        <h1 class="h1 h1-vhod">Регистрация</h1>
        <form class="form-registration" @submit.prevent="submit">
          <div class="form-ryad form-ryad-1 form-ryad-2">
            <div class="form-ryad-1-col form-ryad-1-col-1">
              <p class="text-label-form">Имя</p>
              <input class="pole pole-1 pole-1-1" type="text" v-model="form.name" placeholder="Введите свое имя" required>
            </div>
            <div class="form-ryad-1-col form-ryad-1-col-2">
              <p class="text-label-form">Email</p>
              <input class="pole pole-1 pole-1-2" type="email" v-model="form.email" placeholder="Введите свой email" required>
            </div>
          </div>
          <div class="form-ryad form-ryad-1 form-ryad-2">
            <div class="form-ryad-1-col form-ryad-1-col-3">
              <p class="text-label-form">Пароль</p>
              <input class="pole pole-1 pole-1-3" type="password" v-model="form.password" placeholder="Введите свой пароль" required autocomplete="new-password">
            </div>
          </div>
          <div class="form-ryad form-ryad-1 form-ryad-2">
            <div class="form-ryad-1-col form-ryad-1-col-3">
              <p class="text-label-form">Подтверждение пароля</p>
              <input class="pole pole-1 pole-1-3" type="password" v-model="form.password_confirmation" placeholder="Повторите пароль" required autocomplete="new-password">
            </div>
          </div>
          <div class="form-ryad form-ryad-1 form-ryad-2 form-ryad-3">
            <div class="form-ryad-1-col form-ryad-1-col-1 form-ryad-1-col-4">
              <p class="text-label-form">Мобильный телефон</p>
              <input class="pole pole-1 pole-1-4" type="tel" v-model="form.mobile_phone" placeholder="Введите свой телефон">
            </div>
            <div class="form-ryad-1-col form-ryad-1-col-2 form-ryad-1-col-5">
              <p class="text-label-form">Страна / город</p>
              <input class="pole pole-1 pole-1-5" type="text" v-model="form.location" placeholder="Выберите свой город">
            </div>
          </div>
          <div class="form-ryad form-ryad-1 form-ryad-2 form-ryad-4">
            <button class="button-1 button-2" type="submit">Зарегистрироваться</button>
          </div>
          <div class="form-ryad form-ryad-1 form-ryad-2  form-ryad-5">
            <div class="form-ryad-1-col form-ryad-1-col-3">
              <p class="text-label-form text-label-form-5">Зарегистрироваться с помощью </p>
              <Link :href="route('auth.vk.redirect')"><img src="/img/icon-vk.png" alt="vk"></Link>
            </div>
          </div>
        </form>

        <div class="form-ryad form-ryad-1 form-ryad-2 form-ryad-5 form-ryad-6">
          <p class="text-label-form text-label-form-5">Есть аккаунт?</p>
          <Link class="text-label-form text-label-form-5 link-6" :href="route('login')">Войти</Link>
        </div>
      </div>
    </div>
  </section>

  <footer></footer>
</template>
