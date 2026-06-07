<template>
    <div class="d-flex justify-content-center align-items-center h-100 bg-light">

        <div class="bg-white rounded-4 shadow-sm p-4" style="width: 100%; max-width: 400px;">

            <h1 class="fw-bold mb-4 text-center" style="font-size:1.3rem;">
                Change password
            </h1>
            
            <form @submit.prevent="savePassword" novalidate>
                <!-- Name -->
                <div class="mb-3">
                    <label class="form-label text-muted">Mật khẩu cũ</label>
                    <input type="password" class="form-control" v-model="user.password_old" :class="{ 'is-invalid': errors.password_old }"/>
                    <div class="invalid-feedback" v-if="errors.password_old">
                    {{ errors.password_old[0] }}
                </div>
                </div>
                
                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label text-muted">Mật khẩu mới</label>
                    <input type="password" class="form-control" v-model="user.password" :class="{ 'is-invalid': errors.password }"/>
                    <div class="invalid-feedback" v-if="errors.password">
                        {{ errors.password[0] }}
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted">Xác nhận mật khẩu</label>
                    <input type="password" class="form-control" v-model="user.password_confirmation" :class="{ 'is-invalid': errors.password_confirmation }"/>
                    <div class="invalid-feedback" v-if="errors.password_confirmation">
                        {{ errors.password_confirmation[0] }}
                    </div>
                </div>
                <!-- Button -->
                <div class="d-flex gap-2">
                    <button class="btn btn-success w-100">
                        {{ buttonText }}
                    </button>
                </div>
            </form>

        </div>

    </div>
</template>

<script setup>
import { reactive,ref } from "vue"
import api from "../../../axios"
const errors = ref({})
const buttonText = ref("Lưu")
const user = reactive({
    password_old: "",
    password: "",
    password_confirmation: "",
})

const savePassword = async () => {
    try {
        buttonText.value = "Đang lưu..."

        await api.post('profile/change-password', user)

        buttonText.value = "Thành công"

        user.password_old = ""
        user.password = ""
        user.password_confirmation = ""
        errors.value=""
        setTimeout(() => {
            buttonText.value = "Lưu"
        }, 1500)

    } catch (error) {
        errors.value = error.response?.data?.errors || {}                

    }
}

</script>