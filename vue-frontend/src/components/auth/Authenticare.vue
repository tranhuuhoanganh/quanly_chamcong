<template>
<div class="register-wrapper">
    <div class="container-fluid h-100">
    <div class="row h-100">

        <!-- Left Panel -->
         
        <NavAuth
            title="Welcome Back!"
            subtitle="Đăng nhập để tiếp tục trải nghiệm<br>tất cả tính năng tuyệt vời."
        />
        
        <!-- Right Panel - Form -->
        <div class="col-lg-7 d-flex align-items-center justify-content-center right-panel">
        <div class="form-card w-100">
            <div class="form-header mb-4">
            <h1 class="form-title">Đăng nhập</h1>
            <p class="form-subtitle">Nhập thông tin tài khoản của bạn</p>
            </div>

            <form @submit.prevent="submitLogin" novalidate>

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

            <!-- Password -->
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center">
                <label class="form-label fw-semibold mb-0">Mật khẩu</label>
                <router-link to="/forgot-password" class="forgot-link">Quên mật khẩu?</router-link>
                </div>
                <div class="input-group-custom mt-2">
                <span class="input-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                </span>
                <input
                    :type="showPassword ? 'text' : 'password'"
                    class="form-control custom-input"
                    v-model="formData.password"
                    placeholder="Nhập mật khẩu"
                    :class="{ 'is-invalid': errors.password }"
                />
                <span class="input-icon-right" @click="showPassword = !showPassword" style="cursor:pointer">
                    <svg v-if="!showPassword" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                    <circle cx="12" cy="12" r="3"/>
                    </svg>
                    <svg v-else width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
                    <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
                    <line x1="1" y1="1" x2="23" y2="23"/>
                    </svg>
                </span>
                </div>
                <div class="invalid-feedback" v-if="errors.password">
                {{ errors.password[0] }}
            </div>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn-register w-100 mb-3" :disabled="isLoading">
                <span v-if="isLoading" class="spinner-border spinner-border-sm me-2" role="status"/>
                {{ isLoading ? 'Đang đăng nhập...' : 'Đăng nhập' }}
            </button>

            <p class="text-center login-link">
                Chưa có tài khoản? <router-link to="/register">Đăng ký ngay</router-link>
            </p>
            </form>
        </div>
        </div>

    </div>
    </div>
</div>
</template>

<script setup>
    import { ref,reactive } from 'vue';
    import NavAuth from './NavAuth.vue';
    import { useRouter } from 'vue-router';
    import api from '../../axios';
    import { useAuthStore } from '../../stores/authStore';
    const formData = reactive({
        email: '',
        password:'',
    })
    const errors =ref(0)    
    const isLoading =ref(false)
    const showPassword =ref(false)
    const router = useRouter()
    const authStore = useAuthStore();
    const submitLogin = async() => {
        try{
            const respon= await api.post('authenticare',formData)
            localStorage.setItem('token', respon.data.token);
            router.push('/dashboard')
            authStore.login()
        }catch(error){
            errors.value = error.response?.data?.errors || {}                
        }
    }
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
@import url('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css');
@import '../../css/auth.css';
</style>        