<script setup>
const props = defineProps({
  label: { type: String, default: 'Сортировать по:' },
  options: { type: Array, default: () => ([
    { value: 'calories', label: 'Калории' },
    { value: 'fat', label: 'Жиры' },
    { value: 'carbs', label: 'Углеводы' },
    { value: 'protein', label: 'Белок' },
  ]) },
  modelValue: { type: String, default: 'calories' },
  name: { type: String, default: 'sort' },
  id: { type: String, default: 'pole-filter-2' },
});
const emit = defineEmits(['update:modelValue']);
</script>

<template>
  <div class="katalog-menu-right d-flex align-items-center gap-2">
    <p class="reiting-bluda-text katalog-menu-right-text m-0">{{ __(props.label) }}</p>
    <select class="pole pole-filter pole-filter-2" :name="props.name" :id="props.id" :value="props.modelValue" @change="emit('update:modelValue', $event.target.value)">
      <option v-for="opt in props.options" :key="opt.value" :value="opt.value">{{ __(opt.label) }}</option>
    </select>
  </div>
</template>
