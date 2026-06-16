<template>
    <div>
        <div class="card-body p-1"> <!-- Giảm padding -->

            <!-- Từ ngày -->
            <div class="mb-2">
                <label class="form-label fw-semibold mb-1">Từ ngày</label>
                <input v-model="form.tu_ngay" type="date" class="form-control custom-input-sm"
                    :class="{ 'is-invalid': errors.tu_ngay }" />
                <div class="invalid-feedback" v-if="errors.tu_ngay">
                    {{ errors.tu_ngay[0] }}
                </div>
            </div>

            <!-- Đến ngày -->
            <div class="mb-3">
                <label class="form-label fw-semibold mb-1">Đến ngày</label>
                <input v-model="form.den_ngay" type="date" class="form-control custom-input-sm"
                    :class="{ 'is-invalid': errors.den_ngay }" />
                <div class="invalid-feedback" v-if="errors.den_ngay">
                    {{ errors.den_ngay[0] }}
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold mb-1">Số giờ nghỉ</label>
                <input v-model="form.gio" type="number" class="form-control custom-input-sm"
                    :class="{ 'is-invalid': errors.gio }" />
                <div class="invalid-feedback" v-if="errors.gio">
                    {{ errors.gio[0] }}
                </div>
            </div>

            <!-- Loại nghỉ -->
            <div class="mb-2">
                <label class="fw-semibold mb-2 d-block text-dark">Loại nghỉ:</label>
                <div class="row g-2">
                    <div v-for="loai in danhSachLoaiNghi" :key="loai.type_id" class="col-6 col-md-4 col-lg-3">
                        <div class="form-check">
                            <input v-model="form.loai_nghi" class="form-check-input custom-radio-sm" type="radio"
                                :value="loai.type_id" :class="{ 'is-invalid': errors.loai_nghi }" />
                            <label class="form-check-label" :for="loai.type_id">
                                {{ loai.type_name }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="invalid-feedback" v-if="errors.loai_nghi">
                    {{ errors.loai_nghi[0] }}
                </div>
            </div>

            <!-- Lý do nghỉ -->
            <div class="mb-3">
                <label class="form-label fw-semibold mb-1">Lý do nghỉ</label>
                <textarea v-model="form.ly_do" class="form-control custom-input-sm" rows="3" placeholder="Lý do nghỉ"
                    :class="{ 'is-invalid': errors.ly_do }"></textarea>
                <div class="invalid-feedback" v-if="errors.ly_do">
                    {{ errors.ly_do[0] }}
                </div>
            </div>

            <!-- Nút gửi -->
            <div class="text-center mt-2">
                <button class="btn btn-submit-custom px-4 py-2" @click="guiDon">
                    Gửi đơn
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue'
import api from '../../../axios'
import { useToast } from 'vue-toastification'
const danhSachLoaiNghi = ref([])
const errors = ref({})
const toast = useToast()
const getLoai = async () => {
    const res = await api.get('leave/get-loai')
    danhSachLoaiNghi.value = res.data
}

const form = reactive({
    tu_ngay: '',
    den_ngay: '',
    gio: '',
    du_an: '',
    loai_nghi: '',
    ly_do: '',
})
const guiDon = async () => {
    try {
        const res = await api.post('leave/create-leave', form)
        toast.success(res.data.message)
        Object.assign(form, {
        tu_ngay: '',
        den_ngay: '',
        gio: '',
        du_an: '',
        loai_nghi: '',
        ly_do: '',
    })

    errors.value = {}
    } catch (error) {
            console.log(error.response.data)

        errors.value = error.response?.data?.errors || {}

        if (error.response?.data?.message) {
            toast.error(error.response.data.message)
        }
    }
}
onMounted(() => {
    getLoai()
})
</script>

<style scoped>
.custom-input-sm {
    border-radius: 8px !important;
    padding: 7px 12px !important;
    /* Giảm padding */
    font-size: 0.93rem !important;
    /* Nhỏ hơn tí */
    min-height: 40px;
    /* Giảm chiều cao */
}

.custom-input-sm:focus {
    border-color: #2e7d52 !important;
    box-shadow: 0 0 0 3px rgba(46, 125, 82, 0.15) !important;
}

.custom-radio-sm {
    accent-color: #2e7d52;
    width: 15px;
    height: 15px;
    cursor: pointer;
}

.form-check-label {
    font-size: 0.93rem;
    padding-left: 5px;
    cursor: pointer;
}

.btn-submit-custom {
    background-color: #2e7d52;
    color: #ffffff;
    border: none;
    border-radius: 8px;
    font-size: 1.02rem;
    font-weight: 600;
    padding: 9px 28px !important;
    /* Giảm kích thước nút */
}

.btn-submit-custom:hover {
    background-color: #245e3e;
}
</style>