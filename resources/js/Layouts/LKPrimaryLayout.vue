<script setup>
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3'
import SidebarLeft from '@/Components/SidebarLeft.vue'
import SidebarRight from '@/Components/SidebarRight.vue'

const isSidebarOpen = ref(false)
const toggleSidebar = () => {
  isSidebarOpen.value = !isSidebarOpen.value
}
const closeSidebar = () => {
  isSidebarOpen.value = false
}
</script>

<template>
  <div class="container-fluid p-0">
    <div class="row g-0">
      <!-- Левая боковая панель -->
      <SidebarLeft :open="isSidebarOpen" />

      <!-- Центральная часть -->
      <div class="col-lg-8 main-content" style="margin-left: 0; min-height: 100vh;">
        <!-- Мобильный хедер с бургером -->
        <header class="d-lg-none bg-white border-bottom p-3 d-flex justify-content-between align-items-center">
          <button class="navbar-toggler border-0" type="button" @click="toggleSidebar">
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

      <!-- Правая боковая панель -->
      <div class="col-lg-2 sidebar-right d-none d-lg-block">
        <SidebarRight />
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

  .sidebar-right {
    background: #fff;
    border-left: 1px solid #e0e0e0;
  }

  .overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.4);
    z-index: 1040;
  }
  .overlay.show { display: block; }

  @media (max-width: 992px) {
    .sidebar-left {
      position: fixed;
      top: 0;
      left: -100%;
      width: 280px;
      height: 100vh;
      background: #fff;
      z-index: 1050;
      transition: left 0.3s ease;
      box-shadow: 2px 0 10px rgba(0,0,0,0.1);
      padding-top: 1rem;
    }
    .sidebar-left.show { left: 0; }
    .main-content { margin-left: 0 !important; }
    .sidebar-right { display: none; }
  }
</style>
