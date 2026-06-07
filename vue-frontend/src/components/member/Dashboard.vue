<template>
  <div>
    <div class="row g-3" style="max-width:700px;">

      <div class="col-6">
        <div class="bg-white rounded-3 p-3 border-0 shadow-sm" style="border-top:3px solid #0f766e !important;">
          <div class="text-uppercase text-muted mb-2" style="font-size:0.7rem;letter-spacing:.07em;">
            Users
          </div>

          <div class="fw-bold" style="font-size:2rem;line-height:1;">
            {{ countUser }}
          </div>
        </div>
      </div>

      <div class="col-6">
        <div class="bg-white rounded-3 p-3 border-0 shadow-sm" style="border-top:3px solid #0f766e !important;">
          <div class="text-uppercase text-muted mb-2" style="font-size:0.7rem;letter-spacing:.07em;">
            Department
          </div>

          <div class="fw-bold" style="font-size:2rem;line-height:1;">
            {{ countUser }}
          </div>
        </div>
      </div>

    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import api from '../../axios'

const countUser = ref(0)

const fetchCountUser = async () => {
  const res = await api.get('count_user')
  countUser.value = res.data
}

onMounted(fetchCountUser)
</script>

<style>
.logout-hover:hover {
  background: rgba(239, 68, 68, 0.1) !important;
  color: #f87171 !important;
  border-color: rgba(239, 68, 68, 0.25) !important;
}
</style>