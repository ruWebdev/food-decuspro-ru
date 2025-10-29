<script setup>
import SidebarLeft from '@/Components/SidebarLeft.vue';
import LKHeader from '@/Components/LKHeader.vue';
</script>

<template>
  <div class="body-lk">
    <LKHeader />

    <section class="main-2">
      <div class="container-fluid">
        <div class="row">
          <SidebarLeft />
          <section class="section-cabinet-wrap col-12 col-lg-10">
            <slot />
          </section>
        </div>
      </div>
    </section>
  </div>
</template>
