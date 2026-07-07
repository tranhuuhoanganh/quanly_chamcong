<template>
    <div class="container-fluid py-4">

        <div class="row justify-content-center">

            <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10">

                <div class="card shadow-sm border-0 rounded-4">

                    <!-- Body -->
                    <div class="card-body p-4">

                        <form @submit.prevent="savePassword" novalidate>

                            <!-- Password Old -->
                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Mật khẩu cũ
                                </label>

                                <input type="password" class="form-control" v-model="user.password_old"
                                    :class="{ 'is-invalid': errors.password_old }">

                                <div class="invalid-feedback" v-if="errors.password_old">
                                    {{ errors.password_old[0] }}
                                </div>

                            </div>

                            <!-- Password -->
                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Mật khẩu mới
                                </label>

                                <input type="password" class="form-control" v-model="user.password"
                                    :class="{ 'is-invalid': errors.password }">

                                <div class="invalid-feedback" v-if="errors.password">
                                    {{ errors.password[0] }}
                                </div>

                            </div>

                            <!-- Password Confirmation -->
                            <div class="mb-0">

                                <label class="form-label fw-semibold">
                                    Xác nhận mật khẩu
                                </label>

                                <input type="password" class="form-control" v-model="user.password_confirmation"
                                    :class="{ 'is-invalid': errors.password_confirmation }">

                                <div class="invalid-feedback" v-if="errors.password_confirmation">
                                    {{ errors.password_confirmation[0] }}
                                </div>

                            </div>

                        </form>

                    </div>

                    <!-- Footer -->
                    <div class="card-footer bg-white border-top py-3">

                        <div class="d-flex justify-content-end">

                            <button class="btn btn-success px-4" @click="savePassword">
                                <i class="fa-solid fa-check me-2"></i>

                                {{ buttonText }}
                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
</template>

<script setup>
import { reactive, ref } from "vue";
import api from "../../../axios";
import { useToast } from "vue-toastification";
const errors = ref({});
const buttonText = ref("Lưu");
const toast = useToast();
const user = reactive({
    password_old: "",
    password: "",
    password_confirmation: "",
});

const savePassword = async () => {
    try {
        buttonText.value = "Đang lưu...";

        await api.post("profile/change-password", user);

        buttonText.value = "Thành công";

        user.password_old = "";
        user.password = "";
        user.password_confirmation = "";

        errors.value = {};

        setTimeout(() => {
            buttonText.value = "Lưu";
        }, 1500);
        toast.success("Mật khẩu đã được cập nhật thành công!");
    } catch (error) {
        errors.value = error.response?.data?.errors || {};
        buttonText.value = "Lưu";
        toast.error("Có lỗi xảy ra khi cập nhật mật khẩu!");
    }
};
</script>

<style scoped>
.card {
    border-radius: 20px;
}

.card-header {
    font-size: 18px;
}

.card-body {
    padding: 24px;
}

.form-label {
    font-size: 14px;
    font-weight: 600;
}

.form-control {
    height: 48px;
    border-radius: 12px;
}

.form-control:focus {
    border-color: #198754;
    box-shadow: none;
}

.invalid-feedback {
    display: block;
    font-size: 13px;
}

.btn-success {
    height: 44px;
    border-radius: 50px;
    font-weight: 600;
    padding: 0 28px;
}

.btn-success:hover {
    transform: translateY(-1px);
}
</style>