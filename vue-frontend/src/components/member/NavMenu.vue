<template>
  <div class="border-bottom bg-white shadow-sm rounded-4 px-4" style="height:74px; margin:0 0 20px 20px;">

    <header class="d-flex justify-content-between align-items-center h-100">

      <!-- LEFT -->
      <div class="d-flex flex-column">
        <div class="d-flex align-items-center gap-2">
          <i class="fa-solid fa-chart-line text-primary"></i>

          <span class="fs-4 fw-bold text-dark">
            {{ pageTitle }}
          </span>
        </div>
      </div>

      <!-- RIGHT -->
      <div class="d-flex align-items-center gap-3">

        <!-- Notification -->
        <button class="btn btn-light rounded-4 d-flex align-items-center justify-content-center"
          style="width:42px;height:42px;">
          <i class="fa-regular fa-bell text-secondary"></i>
        </button>

        <!-- User -->
        <div class="d-flex align-items-center gap-2 bg-white border rounded-4 px-3 py-2">
          <div class="d-flex align-items-center justify-content-center fw-semibold text-white"
            style="width:38px;height:38px;border-radius:12px;background:#0f766e;">
            {{ authStore.user?.name?.charAt(0).toUpperCase() }}
          </div>

          <div class="fw-semibold small text-dark">
            {{ authStore.user?.name }}
          </div>
        </div>

        <!-- Logout -->
        <button class="btn btn-light rounded-4 d-flex align-items-center justify-content-center text-danger"
          style="width:42px;height:42px;" @click="logout">
          <i class="fa-solid fa-arrow-right-from-bracket"></i>
        </button>

      </div>

    </header>
  </div>
</template>

<script setup>
import { ref, computed } from "vue";
import api from "../../axios";
import { useRouter, useRoute } from "vue-router";
import { useAuthStore } from "../../stores/authStore";

const errors = ref({});
const router = useRouter();
const route = useRoute();
const authStore = useAuthStore();

const pageTitle = computed(() => route.meta.title || "");

const logout = async () => {
  try {
    await api.get("logout");

    localStorage.removeItem("token");

    authStore.logout();

    router.push("/login");
  } catch (error) {
    errors.value = error.response?.data?.errors || {};
  }
};
</script>