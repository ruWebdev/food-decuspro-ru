<script setup>
const props = defineProps({
  title: { type: String, required: true },
});
</script>

<template>
  <section class="section-title d-flex justify-content-between align-items-center flex-wrap gap-2">
    <h1 class="h1 h1-vhod h1-lk mb-0">{{ props.title }}</h1>
    <div class="section-title-right d-flex align-items-center gap-3">
      <slot name="right" />
    </div>
  </section>
</template>
