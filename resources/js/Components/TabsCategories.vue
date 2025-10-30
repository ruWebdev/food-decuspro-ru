<script setup>
const props = defineProps({
  categories: { type: Array, default: () => ([]) },
  modelValue: { type: String, default: '' },
});
const emit = defineEmits(['update:modelValue']);

function select(cat) {
  emit('update:modelValue', cat.value ?? cat);
}
</script>

<template>
  <div class="blok-tab-title">
    <template v-for="(cat, idx) in props.categories" :key="idx">
      <div
        class="tab-title-element"
        :class="`tab-title-element-${idx+1}`"
        @click="select(cat)"
      >
        {{ typeof cat === 'string' ? cat : cat.label }}
      </div>
    </template>
    <slot />
  </div>
</template>
