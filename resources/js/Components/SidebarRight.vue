<script setup>
</script>

<template>
  <div class="p-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h6 class="mb-0">{{ __('Адам Василенко') }}</h6>
      <small class="text-muted">{{ __('Участник') }}</small>
    </div>
    <hr>
    <h6 class="mb-3">{{ __('Популярные блюда') }}</h6>
    <div class="d-flex flex-column gap-3">
      <div class="d-flex align-items-center gap-2">
        <img src="https://via.placeholder.com/50x50/DDD/FFF?text=G" class="rounded" width="50" alt="">
        <div>
          <div class="small fw-semibold">Greek Salad with Feta and Olives</div>
          <div class="text-muted" style="font-size: 0.7rem;">4.9/5 • {{ __('Обед') }}</div>
        </div>
        <button class="btn btn-outline-success btn-sm ms-auto">+</button>
      </div>
    </div>
    <hr class="my-4">
    <h6 class="mb-3">{{ __('Мои блюда') }}</h6>
    <div class="d-flex flex-column gap-3">
      <div class="d-flex align-items-center gap-2">
        <img src="https://via.placeholder.com/50x50/DDD/FFF?text=O" class="rounded" width="50" alt="">
        <div>
          <div class="small fw-semibold">{{ __('Овсяная каша с миндальным маслом') }}</div>
          <div class="text-muted" style="font-size: 0.7rem;">{{ __('Завтрак') }}</div>
        </div>
        <button class="btn btn-outline-success btn-sm ms-auto">+</button>
      </div>
    </div>
  </div>
</template>
