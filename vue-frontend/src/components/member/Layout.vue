<template>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

  <div class="d-flex vh-100 " style="padding: 20px; background: #edf7ee ;">
    <!-- Sidebar -->
    <Sidebar />

    <!-- Main -->
    <div class="flex-grow-1 d-flex flex-column overflow-hidden">

        <NavMenu />
        
      <main class="flex-grow-1 overflow-auto p-4  bg-white shadow-sm rounded-4 " style="margin: 0 0 0 20px;">
        <router-view />
      </main>
    </div>
  </div>
</template>

<script setup>
  import Sidebar from "./Sidebar.vue";
  import NavMenu from "./NavMenu.vue";
</script>

<style scoped>
.bg-light {
  background: #f1f5f9 !important;
}
</style>