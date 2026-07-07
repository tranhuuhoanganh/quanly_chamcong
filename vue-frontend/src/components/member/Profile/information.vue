<template>
    <div class="container-fluid py-4">

        <form @submit.prevent="saveEmployee">

            <div class="row justify-content-center">

                <div class="col-xl-7 col-lg-8 col-md-10">

                    <div class="card shadow-sm border-0 rounded-4">



                        <div class="card-body p-4">
                            <!-- Email -->
                            <div class="mb-0">

                                <label class="form-label fw-semibold">
                                    Email
                                </label>

                                <input type="email" class="form-control" v-model="formData.email"
                                    :class="{ 'is-invalid': errors.email }">

                                <div class="invalid-feedback">
                                    {{ errors.email?.[0] }}
                                </div>

                            </div>
                            <!-- Họ tên -->
                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Họ và tên
                                </label>

                                <input type="text" class="form-control" v-model="formData.fullname"
                                    :class="{ 'is-invalid': errors.fullname }">

                                <div class="invalid-feedback">
                                    {{ errors.fullname?.[0] }}
                                </div>

                            </div>

                            <!-- Ngày sinh -->
                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Ngày sinh
                                </label>

                                <input type="date" class="form-control" v-model="formData.birthday"
                                    :class="{ 'is-invalid': errors.birthday }">

                                <div class="invalid-feedback">
                                    {{ errors.birthday?.[0] }}
                                </div>

                            </div>

                            <!-- Giới tính -->
                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Giới tính
                                </label>

                                <select class="form-select" v-model="formData.sex"
                                    :class="{ 'is-invalid': errors.sex }">

                                    <option value="">
                                        -- Chọn giới tính --
                                    </option>

                                    <option value="nam">
                                        Nam
                                    </option>

                                    <option value="nữ">
                                        Nữ
                                    </option>

                                </select>

                                <div class="invalid-feedback">
                                    {{ errors.sex?.[0] }}
                                </div>

                            </div>

                            <!-- SĐT -->
                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Số điện thoại
                                </label>

                                <input type="text" class="form-control" v-model="formData.phone"
                                    :class="{ 'is-invalid': errors.phone }">

                                <div class="invalid-feedback">
                                    {{ errors.phone?.[0] }}
                                </div>

                            </div>

                            

                        </div>

                        <div class="card-footer bg-white border-top py-3">

                            <div class="d-flex justify-content-end">

                                <button type="submit" class="btn btn-success px-4">
                                    <i class="fa-solid fa-check me-2"></i>
                                    Save
                                </button>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </form>

    </div>
</template>

<script setup>
import { onMounted, reactive, ref } from "vue";
import api from "../../../axios";
import { useToast } from "vue-toastification";
const errors = ref({});
const toast = useToast();
const formData = reactive({
    fullname: "",
    birthday: "",
    sex: "",
    phone: "",
    email: "",
});
const getInformation = async () => {
    try {
        const { data } = await api.get("profile");
        Object.assign(formData, data);
        console.log(data);
    } catch (error) {
        console.log(error);
    }
}
const saveEmployee = async() => {
    try {
        await api.put(`profile/update-profile/${formData.id}`, formData);
        toast.success("Cập nhật thông tin thành công!");
        getInformation();
    } catch (error) {
        errors.value = error.response?.data?.errors || {};
        toast.error("Có lỗi xảy ra khi cập nhật thông tin!");
    }
};
onMounted(() => {
    getInformation();
});
</script>

<style scoped>
.card {
    border-radius: 20px;
}

.form-control,
.form-select {

    height: 48px;

    border-radius: 12px;

}

.form-control:focus,
.form-select:focus {

    box-shadow: none;

    border-color: #198754;

}

.btn-success {

    border-radius: 50px;

    height: 44px;

    font-weight: 600;

}

.card-header {

    font-size: 18px;

}
</style>