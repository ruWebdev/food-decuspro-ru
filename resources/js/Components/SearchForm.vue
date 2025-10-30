<script setup>
const props = defineProps({
  placeholder: { type: String, default: 'Поиск в меню' },
  action: { type: String, default: '#' },
  name: { type: String, default: 'q' },
});
</script>

<template>
  <div class="blok-search blok-search-2">
    <form :action="props.action" method="get" class="search" @submit.prevent>
      <input type="search" :name="props.name" :placeholder="props.placeholder" class="input" />
      <input type="submit" value="" class="submit" />
    </form>
  </div>
</template>
