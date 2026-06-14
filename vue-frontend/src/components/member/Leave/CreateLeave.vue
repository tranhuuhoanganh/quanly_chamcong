<template>
    <div>
        <div class="card-body p-2">   <!-- Giảm padding -->
            
            <!-- Từ ngày -->
            <div class="mb-2">
                <label class="form-label fw-semibold mb-1">Từ ngày</label>
                <input v-model="form.tu_ngay" type="date" class="form-control custom-input-sm" />
            </div>

            <!-- Đến ngày -->
            <div class="mb-2">
                <label class="form-label fw-semibold mb-1">Đến ngày</label>
                <input v-model="form.den_ngay" type="date" class="form-control custom-input-sm" />
            </div>

            <!-- Dự án -->
            <div class="mb-2">
                <label class="form-label fw-semibold mb-1">Chọn dự án</label>
                <select v-model="form.du_an" class="form-select custom-input-sm">
                    <option value="">~Chọn dự án đang tham gia</option>
                    <option v-for="da in danhSachDuAn" :key="da.id" :value="da.id">
                        {{ da.ten }}
                    </option>
                </select>
            </div>

            <!-- Loại nghỉ -->
            <div class="mb-3">
                <label class="fw-semibold mb-2 d-block text-dark">Loại nghỉ:</label>
                <div class="row g-2">
                    <div v-for="loai in danhSachLoaiNghi" :key="loai.value" class="col-6 col-md-4 col-lg-3">
                        <div class="form-check">
                            <input v-model="form.loai_nghi" class="form-check-input custom-radio-sm" type="radio"
                                :value="loai.value" :id="'loai_' + loai.value" />
                            <label class="form-check-label" :for="'loai_' + loai.value">
                                {{ loai.label }}
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lý do nghỉ -->
            <div class="mb-2">
                <label class="form-label fw-semibold mb-1">Lý do nghỉ</label>
                <textarea v-model="form.ly_do" class="form-control custom-input-sm" rows="3"
                    placeholder="Lý do nghỉ"></textarea>
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
import { ref, reactive } from 'vue'
const danhSachLoaiNghi = [
    { value: 'phep_nam', label: 'Nghỉ phép năm' },
    { value: 'thai_san', label: 'Nghỉ thai sản' },
    { value: 'khong_luong', label: 'Nghỉ phép không hưởng lương' },
    { value: 'benh', label: 'Nghỉ phép bệnh' },
    { value: 'bu', label: 'Nghỉ phép bù' },
    { value: 'ket_hon', label: 'Nghỉ kết hôn' },
    { value: 'hoc_tap', label: 'Nghỉ phép học tập, đào tạo' },
    { value: 'tang', label: 'Nghỉ tang' },
]

const danhSachDuAn = ref([
    { id: 1, ten: 'Dự án A' },
    { id: 2, ten: 'Dự án B' },
    { id: 3, ten: 'Dự án C' },
])

const form = reactive({
    tu_ngay: '',
    den_ngay: '',
    du_an: '',
    loai_nghi: '',
    ly_do: '',
})

const guiDon = () => {
    console.log('Dữ liệu gửi đơn:', form)
}
</script>

<style scoped>
.custom-input-sm {
    border-radius: 8px !important;
    padding: 7px 12px !important;     /* Giảm padding */
    font-size: 0.93rem !important;    /* Nhỏ hơn tí */
    min-height: 40px;                 /* Giảm chiều cao */
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
    padding: 9px 28px !important;     /* Giảm kích thước nút */
}

.btn-submit-custom:hover {
    background-color: #245e3e;
}
</style>