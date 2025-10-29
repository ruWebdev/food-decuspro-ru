<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
  title: {
    type: String,
    required: true,
  },
  description: {
    type: String,
    required: true,
  },
});
</script>

<template>
  <AuthenticatedLayout>
    <Head :title="props.title" />

    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ props.title }}
      </h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
          <div class="border-b border-gray-200 bg-white p-6">
            <p class="text-gray-700">
              {{ props.description }}
            </p>
            <div class="mt-6 space-y-6">
              <section class="rounded-lg border border-dashed border-gray-300 p-6">
                <h3 class="text-lg font-semibold text-gray-900">
                  {{ __('Настройки профиля') }}
                </h3>
                <p class="mt-2 text-sm text-gray-500">
                  {{ __('Скоро здесь появится возможность обновлять личные данные и предпочтения.') }}
                </p>
              </section>
              <section class="rounded-lg border border-dashed border-gray-300 p-6">
                <h3 class="text-lg font-semibold text-gray-900">
                  {{ __('Конфиденциальность и безопасность') }}
                </h3>
                <p class="mt-2 text-sm text-gray-500">
                  {{ __('Мы добавим управление паролями, двухфакторной аутентификацией и другими параметрами безопасности.') }}
                </p>
              </section>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
