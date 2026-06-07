<template>
    <div class="col-lg-5 d-none d-lg-flex left-panel align-items-center justify-content-center">
        <div class="left-content text-center">

            <div class="brand-icon mb-4">
                <svg width="64" height="64" viewBox="0 0 64 64" fill="none">
                    <rect width="64" height="64" rx="16" fill="rgba(255,255,255,0.15)"/>
                    <path d="M20 32 L32 20 L44 32 L32 44 Z" fill="white" opacity="0.9"/>
                    <circle cx="32" cy="32" r="6" fill="white"/>
                </svg>
            </div>

            <h2 class="left-title">{{ title }}</h2>

            <p class="left-subtitle" v-html="subtitle"></p>

            <div class="features mt-5">
                <div class="feature-item">
                    <span class="feature-icon">⚡</span>
                    <span class="feature-text">Truy cập nhanh chóng, mọi lúc mọi nơi</span>
                </div>

                <div class="feature-item">
                    <span class="feature-icon">🔒</span>
                    <span class="feature-text">Bảo mật dữ liệu tuyệt đối</span>
                </div>

                <div class="feature-item">
                    <span class="feature-icon">🎯</span>
                    <span class="feature-text">Trải nghiệm được cá nhân hóa</span>
                </div>
            </div>

        </div>
    </div>
</template>

<script setup>
defineProps({
    title: String,
    subtitle: String
})
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
@import url('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css');
@import '../../css/auth.css';
</style>