<template>
  <div class="register-wrapper">
    <div class="container-fluid h-100">
      <div class="row h-100">

        <!-- Left Panel -->
        <NavAuth
            title="Create New Password"
            subtitle="Mật khẩu mới giúp bảo vệ<br>tài khoản của bạn an toàn hơn."
        />

        <!-- Right Panel - Form -->
        <div class="col-lg-7 d-flex align-items-center justify-content-center right-panel">
          <div class="form-card w-100">
            <div class="form-header mb-4">
              <h1 class="form-title">Reset password</h1>
              <p class="form-subtitle">Điền thông tin bên dưới để reset-password</p>
            </div>

            <form @submit.prevent="ResetPassword" novalidate>
              <!-- Email -->
              <div class="mb-4">
                <label class="form-label fw-semibold">Email</label>
                <div class="input-group-custom">
                  <span class="input-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                      <polyline points="22,6 12,13 2,6" />
                    </svg>
                  </span>
                  <input type="email" class="form-control custom-input" placeholder="example@email.com"
                    v-model="formData.email" />

                </div>
                <div class="invalid-feedback" v-if="errors.email">
                  {{ errors.email[0] }}
                </div>
              </div>

              <!-- Password -->
              <div class="mb-4">
                <label class="form-label fw-semibold">Mật khẩu</label>
                <div class="input-group-custom">
                  <span class="input-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                      <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                    </svg>
                  </span>
                  <input type="password" class="form-control custom-input" placeholder="Tối thiểu 8 ký tự"
                    v-model="formData.password" />
                </div>
                <div class="invalid-feedback" v-if="errors.password">
                  {{ errors.password[0] }}
                </div>
              </div>

              <!-- Confirm Password -->
              <div class="mb-4">
                <label class="form-label fw-semibold">Xác nhận mật khẩu</label>
                <div class="input-group-custom">
                  <span class="input-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                    </svg>
                  </span>
                  <input type="password" class="form-control custom-input" placeholder="Nhập lại mật khẩu"
                    v-model="formData.password_confirmation" />
                </div>
                <div class="invalid-feedback" v-if="errors.password_confirmation">
                  {{ errors.password_confirmation[0] }}
                </div>
              </div>

             

              <!-- Submit -->
              <button type="submit" class="btn-register w-100 mb-3">
                reset-password
              </button>

              <p class="text-center login-link">
                Đã có tài khoản? <router-link to="/login">Đăng nhập ngay</router-link>
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
import { useRouter, useRoute } from 'vue-router'
import api from '../../axios'
import NavAuth from './NavAuth.vue'
const errors = ref({})
const router = useRouter()
const route = useRoute()

const formData = reactive({
  email: '',
  password: '',
  password_confirmation: '',
  token: route.params.token
})


const ResetPassword = async () => {
  try {
    const respon = await api.post('reset-password', formData);
    router.push('/login')
  } catch (error) {
    errors.value = error.response.data.errors
  }
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
@import url('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css');

@import '../../css/auth.css';
</style>