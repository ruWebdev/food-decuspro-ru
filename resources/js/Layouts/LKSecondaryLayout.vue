<script setup>
 import { ref } from 'vue'
 import SidebarLeft from '@/Components/SidebarLeft.vue'

 const isSidebarOpen = ref(false)
 const toggleSidebar = () => { isSidebarOpen.value = !isSidebarOpen.value }
 const closeSidebar = () => { isSidebarOpen.value = false }
</script>

<template>
  <div class="container-fluid p-0">
    <div class="row g-0">
      <!-- Левая колонка -->
      <SidebarLeft :open="isSidebarOpen" />

      <!-- Центральная колонка -->
      <div class="col-lg-10 main-content" style="min-height: 100vh;">
        <!-- Мобильный хедер -->
        <header class="mobile-header bg-white border-bottom p-3 d-flex justify-content-between align-items-center d-lg-none">
          <button class="navbar-toggler border-0 p-2" type="button" @click="toggleSidebar">
            <i class="bi bi-list fs-3"></i>
          </button>
          <span class="logo fs-5">{{ __('ЛОГОТИП') }}</span>
          <div></div>
        </header>

        <!-- Основное содержимое -->
        <main class="p-3 p-lg-4">
          <slot />
        </main>
      </div>
    </div>

    <!-- Overlay для мобильного меню -->
    <div class="overlay" :class="{ show: isSidebarOpen }" @click="closeSidebar"></div>
  </div>
</template>

<style scoped>
 .logo {
   font-weight: bold;
   font-size: 1.1rem;
   color: #A3CB38;
 }
 .overlay {
   display: none;
   position: fixed;
   inset: 0;
   background: rgba(0,0,0,0.4);
   z-index: 1040;
 }
 .overlay.show { display: block; }
 @media (max-width: 992px) {
   .main-content { margin-left: 0 !important; }
 }
</style>
