<template>
    <div class="register-wrapper">
      <div class="container-fluid h-100">
        <div class="row h-100">
  
          <!-- Left Panel -->
          <NavAuth
            title="Forgot Password?"
            subtitle="Nhập email để khôi phục<br>và đặt lại mật khẩu."
          />
  
          <!-- Right Panel - Form -->
          <div class="col-lg-7 d-flex align-items-center justify-content-center right-panel">
            <div class="form-card w-100">
              <div class="form-header mb-4">
                <h1 class="form-title">Quên mật khẩu</h1>
                <p class="form-subtitle">Nhập thông tin tài khoản của bạn</p>
              </div>
  
              <form @submit.prevent="forgotPassword" novalidate>
  
                <!-- Email -->
                <div class="mb-4">
                  <label class="form-label fw-semibold">Email</label>
                  <div class="input-group-custom">
                    <span class="input-icon">
                      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                        <polyline points="22,6 12,13 2,6"/>
                      </svg>
                    </span>
                    <input
                      type="email"
                      class="form-control custom-input"
                      v-model="formData.email"
                      placeholder="example@email.com"
                      :class="{ 'is-invalid': errors.email }"
                    />
                  </div>
                  <div class="invalid-feedback" v-if="errors.email">
                    {{ errors.email[0] }}
                  </div>
                </div>
  
                
  
                <!-- Submit -->
                <button type="submit" class="btn-register w-100 mb-3" :disabled="isLoading">
                  <span v-if="isLoading" class="spinner-border spinner-border-sm me-2" role="status"/>
                  {{ isLoading ? 'Đang loading' : 'Email link' }}
                </button>
  
                <p class="text-center login-link">
                  Bạn đã có tài khoản?<router-link to="/login">Đăng nhập</router-link>
                </p>
              </form>
            </div>
          </div>
  
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { reactive, ref } from 'vue'
  import api from '../../axios'
  import NavAuth from './NavAuth.vue'
  import { useRouter } from 'vue-router'
  
  const formData = reactive({
    email: '',
  })
  
  const router = useRouter()
  const errors = ref({})
  const isLoading = ref(false)
  
  const forgotPassword = async () => {
  
    isLoading.value = true
    try {
      const respon = await api.post('forgot-password', formData);
    } catch (error) {
        errors.value = error.response.data.errors
    } finally {
      isLoading.value = false
    }
  }
  </script>
  
  <style scoped>
  @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
  @import url('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css');
  @import '../../css/auth.css';
</style>        