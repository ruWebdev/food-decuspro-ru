<script setup>
import { Link } from '@inertiajs/vue3';
import SidebarRight from '@/Components/SidebarRight.vue';
import SidebarLeft from '@/Components/SidebarLeft.vue';
import LKHeader from '@/Components/LKHeader.vue';
</script>

<template>
  <div class="body-lk">
    <!-- header -->
    <LKHeader />

    <!-- main -->
    <section class="main-2">
      <div class="container-fluid">
        <div class="row">
      <!-- sidebar -->
      <SidebarLeft />

      <!-- content wrapper -->
      <section class="section-cabinet-wrap col-12 col-lg-7">
        <slot />
      </section>
      <div class="col-12 col-lg-3">
        <SidebarRight />
      </div>
        </div>
      </div>
    </section>
  </div>
</template>
