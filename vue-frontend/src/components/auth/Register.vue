<template>
    <div class="register-wrapper">
        <div class="container-fluid h-100">
            <div class="row h-100">

                <!-- Left Panel -->
                <NavAuth
                    title="Create Account"
                    subtitle="Đăng ký để bắt đầu sử dụng<br>mọi tính năng của hệ thống."
                />

                <!-- Right Panel - Form -->
                <div class="col-lg-7 d-flex align-items-center justify-content-center right-panel">
                    <div class="form-card w-100">
                        <div class="form-header mb-4">
                            <h1 class="form-title">Tạo tài khoản</h1>
                            <p class="form-subtitle">Điền thông tin bên dưới để đăng ký</p>
                        </div>

                        <form @submit.prevent="submitRegister" novalidate>

                            <!-- Name -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Họ và tên</label>
                                <div class="input-group-custom">
                                    <span class="input-icon">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                            <circle cx="12" cy="7" r="4" />
                                        </svg>
                                    </span>
                                    <input type="text" class="form-control custom-input" v-model="formData.name"
                                        placeholder="Nguyễn Văn A" />
                                </div>
                                <div class="invalid-feedback" v-if="errors.name">
                                    {{ errors.name[0] }}
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Email</label>
                                <div class="input-group-custom">
                                    <span class="input-icon">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2">
                                            <path
                                                d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                            <polyline points="22,6 12,13 2,6" />
                                        </svg>
                                    </span>
                                    <input type="email" class="form-control custom-input" v-model="formData.email"
                                        placeholder="example@email.com" />
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
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2">
                                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                                            <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                        </svg>
                                    </span>
                                    <input type="password" class="form-control custom-input" v-model="formData.password"
                                        placeholder="Tối thiểu 8 ký tự" />
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
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2">
                                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                                        </svg>
                                    </span>
                                    <input type="password" class="form-control custom-input"
                                        v-model="formData.password_confirmation" placeholder="Nhập lại mật khẩu" />
                                </div>
                                <div class="invalid-feedback" v-if="errors.password_confirmation">
                                    {{ errors.password_confirmation[0] }}
                                </div>
                            </div>

                            <!-- Terms -->
                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="agreeTerms" />
                                    <label class="form-check-label" for="agreeTerms">
                                        Tôi đồng ý với <a href="#" class="terms-link">Điều khoản dịch vụ</a> và <a
                                            href="#" class="terms-link">Chính sách bảo mật</a>
                                    </label>
                                </div>
                            </div>

                            <!-- Submit -->
                            <button type="submit" class="btn-register w-100 mb-3">
                                Tạo tài khoản
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
import { ref,reactive } from 'vue';
import { useRouter } from 'vue-router';
import api from '../../axios';
import NavAuth from './NavAuth.vue';
const formData = reactive({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
})
const errors = ref({});
const router = useRouter();

const submitRegister = async() =>{
    try{
        await api.post('register',formData)
        router.push('/login')
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