<template>
    <div class="modal fade show d-block custom-modal" tabindex="-1">

        <div class="modal-dialog modal-xl modal-dialog-centered custom-modal-width">

            <div class="modal-content border-0 rounded-4 shadow-lg">

                <!-- Header -->
                <div class="modal-header border-0 px-4 pt-3 pb-2">

                    <div>
                        <h5 class="fw-bold mb-1 text-dark">
                            Create Employee
                        </h5>

                        <p class="text-secondary mb-0 small">
                            Thêm thông tin nhân viên mới vào hệ thống
                        </p>
                    </div>

                    <button type="button" class="btn-close" @click="emit('close')"></button>

                </div>

                <!-- Body -->
                <div class="modal-body px-4 pt-2">

                    <!-- Step Progress -->
                    <div class="wizard-steps mb-4">

                        <div class="wizard-step" :class="{ active: currentStep === 1, done: currentStep > 1 }">
                            <div class="wizard-circle">
                                <i class="fa-solid fa-check" v-if="currentStep > 1"></i>
                                <span v-else>1</span>
                            </div>
                            <div class="wizard-title">Thông tin cá nhân</div>
                        </div>

                        <div class="wizard-line" :class="{ filled: currentStep > 1 }"></div>

                        <div class="wizard-step" :class="{ active: currentStep === 2, done: currentStep > 2 }">
                            <div class="wizard-circle">
                                <i class="fa-solid fa-check" v-if="currentStep > 2"></i>
                                <span v-else>2</span>
                            </div>
                            <div class="wizard-title">Thông tin công việc</div>
                        </div>

                        <div class="wizard-line" :class="{ filled: currentStep > 2 }"></div>

                        <div class="wizard-step" :class="{ active: currentStep === 3, done: currentStep > 3 }">
                            <div class="wizard-circle">
                                <i class="fa-solid fa-check" v-if="currentStep > 3"></i>
                                <span v-else>3</span>
                            </div>
                            <div class="wizard-title">Hợp đồng lao động</div>
                        </div>

                    </div>

                    <form @submit.prevent novalidate>

                        <transition name="step-fade" mode="out-in">

                            <!-- ================= STEP 1 ================= -->
                            <div v-if="currentStep === 1" key="step1">

                                <div class="card border-0 rounded-4 shadow-sm bg-body-tertiary">

                                    <div class="card-body">

                                        <h6 class="fw-bold d-flex align-items-center gap-2 mb-3">
                                            <i class="fa-solid fa-user text-success"></i>
                                            Thông tin cá nhân
                                        </h6>

                                        <div class="row g-3">

                                            <!-- Employee Code -->
                                            <div class="col-md-6">

                                                <label class="form-label fw-semibold">
                                                    Mã nhân viên
                                                </label>

                                                <input type="text" class="form-control rounded-4"
                                                    v-model="formData.emp_code"
                                                    :class="{ 'is-invalid': errors.emp_code }">

                                                <div class="invalid-feedback" v-if="errors.emp_code">
                                                    {{ errors.emp_code[0] }}
                                                </div>
                                            </div>

                                            <!-- Fullname -->
                                            <div class="col-md-6">

                                                <label class="form-label fw-semibold">
                                                    Họ và tên
                                                </label>

                                                <input type="text" class="form-control rounded-4"
                                                    v-model="formData.fullname"
                                                    :class="{ 'is-invalid': errors.fullname }">

                                                <div class="invalid-feedback" v-if="errors.fullname">
                                                    {{ errors.fullname[0] }}
                                                </div>

                                            </div>

                                            <!-- Birthday -->
                                            <div class="col-md-6">

                                                <label class="form-label fw-semibold">
                                                    Ngày sinh
                                                </label>

                                                <input type="date" class="form-control rounded-4"
                                                    v-model="formData.birthday"
                                                    :class="{ 'is-invalid': errors.birthday }">

                                                <div class="invalid-feedback" v-if="errors.birthday">
                                                    {{ errors.birthday[0] }}
                                                </div>

                                            </div>

                                            <!-- Gender -->
                                            <div class="col-md-6">

                                                <label class="form-label fw-semibold">
                                                    Giới tính
                                                </label>

                                                <select class="form-select rounded-4" v-model="formData.sex"
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
                                                <div class="invalid-feedback" v-if="errors.sex">
                                                    {{ errors.sex[0] }}
                                                </div>
                                            </div>

                                            <!-- Phone -->
                                            <div class="col-md-6">

                                                <label class="form-label fw-semibold">
                                                    Số điện thoại
                                                </label>

                                                <input type="text" class="form-control rounded-4"
                                                    v-model="formData.phone"
                                                    :class="{ 'is-invalid': errors.phone }">

                                                <div class="invalid-feedback" v-if="errors.phone">
                                                    {{ errors.phone[0] }}
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <!-- ================= STEP 2 ================= -->
                            <div v-else-if="currentStep === 2" key="step2">

                                <div class="card border-0 rounded-4 shadow-sm bg-body-tertiary">

                                    <div class="card-body">

                                        <h6 class="fw-bold d-flex align-items-center gap-2 mb-3">
                                            <i class="fa-solid fa-briefcase text-success"></i>
                                            Thông tin công việc
                                        </h6>

                                        <div class="row g-3">

                                            <!-- Email -->
                                            <div class="col-md-6">

                                                <label class="form-label fw-semibold">
                                                    Email
                                                </label>

                                                <input type="email" class="form-control rounded-4"
                                                    v-model="formData.email"
                                                    :class="{ 'is-invalid': errors.email }">

                                                <div class="invalid-feedback" v-if="errors.email">
                                                    {{ errors.email[0] }}
                                                </div>

                                            </div>

                                            <!-- Password -->
                                            <div class="col-md-6">

                                                <label class="form-label fw-semibold">
                                                    Password
                                                </label>

                                                <input type="password" class="form-control rounded-4"
                                                    v-model="formData.password"
                                                    :class="{ 'is-invalid': errors.password }">

                                                <div class="invalid-feedback" v-if="errors.password">
                                                    {{ errors.password[0] }}
                                                </div>

                                            </div>

                                            <!-- Hire Date -->
                                            <div class="col-md-6">

                                                <label class="form-label fw-semibold">
                                                    Ngày vào làm
                                                </label>

                                                <input type="date" class="form-control rounded-4"
                                                    v-model="formData.hire_date"
                                                    :class="{ 'is-invalid': errors.hire_date }">
                                                <div class="invalid-feedback" v-if="errors.hire_date">
                                                    {{ errors.hire_date[0] }}
                                                </div>

                                            </div>

                                            <!-- Department -->
                                            <div class="col-md-6">

                                                <label class="form-label fw-semibold">
                                                    Phòng ban
                                                </label>

                                                <select class="form-select rounded-4" v-model="formData.depart_id"
                                                    :class="{ 'is-invalid': errors.depart_id }">
                                                    <option value="">
                                                        -- Chọn phòng ban --
                                                    </option>
                                                    <option v-for="depart in departments" :key="depart.depart_id"
                                                        :value="depart.depart_id">{{ depart.depart_name }}</option>
                                                </select>
                                                <div class="invalid-feedback" v-if="errors.depart_id">
                                                    {{ errors.depart_id[0] }}
                                                </div>
                                            </div>

                                            <!-- Position -->
                                            <div class="col-md-6">

                                                <label class="form-label fw-semibold">
                                                    Chức vụ
                                                </label>

                                                <select class="form-select rounded-4" v-model="formData.pos_id"
                                                    :class="{ 'is-invalid': errors.pos_id }">
                                                    <option value="">
                                                        -- Chọn chức vụ --
                                                    </option>
                                                    <option v-for="pos in positions" :key="pos.pos_id"
                                                        :value="pos.pos_id">
                                                        {{ pos.pos_name }}</option>

                                                </select>
                                                <div class="invalid-feedback" v-if="errors.pos_id">
                                                    {{ errors.pos_id[0] }}
                                                </div>
                                            </div>

                                            <!-- Role -->
                                            <div class="col-md-6">

                                                <label class="form-label fw-semibold">
                                                    Vai trò
                                                </label>

                                                <select class="form-select rounded-4" v-model="formData.role_id"
                                                    :class="{ 'is-invalid': errors.role_id }">
                                                    <option value="">
                                                        -- Chọn vai trò --
                                                    </option>
                                                    <option v-for="role in roles" :key="role.role_id"
                                                        :value="role.role_id">
                                                        {{ role.role_name }}</option>

                                                </select>
                                                <div class="invalid-feedback" v-if="errors.role_id">
                                                    {{ errors.role_id[0] }}
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <!-- ================= STEP 3 ================= -->
                            <div v-else-if="currentStep === 3" key="step3">

                                <div class="card border-0 rounded-4 shadow-sm bg-body-tertiary">

                                    <div class="card-body">

                                        <h6 class="fw-bold d-flex align-items-center gap-2 mb-3">
                                            <i class="fa-solid fa-file-signature text-success"></i>
                                            Hợp đồng lao động
                                        </h6>

                                        <div class="row g-3">

                                            <!-- Lương cơ bản -->
                                            <div class="col-md-6">

                                                <label class="form-label fw-semibold">
                                                    Lương cơ bản
                                                </label>

                                                <input type="number" class="form-control rounded-4"
                                                    v-model="formData.luongCoBan"
                                                    :class="{ 'is-invalid': errors.luongCoBan }">

                                                <div class="invalid-feedback" v-if="errors.luongCoBan">
                                                    {{ errors.luongCoBan[0] }}
                                                </div>

                                            </div>

                                            <!-- Lương đóng bảo hiểm -->
                                            <div class="col-md-6">

                                                <label class="form-label fw-semibold">
                                                    Lương đóng bảo hiểm
                                                </label>

                                                <input type="number" class="form-control rounded-4"
                                                    v-model="formData.insurance_salary"
                                                    :class="{ 'is-invalid': errors.insurance_salary }">

                                                <div class="invalid-feedback" v-if="errors.insurance_salary">
                                                    {{ errors.insurance_salary[0] }}
                                                </div>

                                            </div>

                                            <!-- Phụ cấp chức vụ -->
                                            <div class="col-md-6">

                                                <label class="form-label fw-semibold">
                                                    Phụ cấp chức vụ
                                                </label>

                                                <input type="number" class="form-control rounded-4"
                                                    v-model="formData.phuCapChucVu"
                                                    :class="{ 'is-invalid': errors.phuCapChucVu }">

                                                <div class="invalid-feedback" v-if="errors.phuCapChucVu">
                                                    {{ errors.phuCapChucVu[0] }}
                                                </div>

                                            </div>

                                            <!-- Phụ cấp sinh hoạt -->
                                            <div class="col-md-6">

                                                <label class="form-label fw-semibold">
                                                    Phụ cấp sinh hoạt
                                                </label>

                                                <input type="number" class="form-control rounded-4"
                                                    v-model="formData.phuCapSinhHoat"
                                                    :class="{ 'is-invalid': errors.phuCapSinhHoat }">

                                                <div class="invalid-feedback" v-if="errors.phuCapSinhHoat">
                                                    {{ errors.phuCapSinhHoat[0] }}
                                                </div>

                                            </div>

                                            <!-- Ngày bắt đầu hợp đồng -->
                                            <div class="col-md-6">

                                                <label class="form-label fw-semibold">
                                                    Ngày bắt đầu hợp đồng
                                                </label>

                                                <input type="date" class="form-control rounded-4"
                                                    v-model="formData.start_date"
                                                    :class="{ 'is-invalid': errors.start_date }">
                                                <div class="invalid-feedback" v-if="errors.start_date">
                                                    {{ errors.start_date[0] }}
                                                </div>

                                            </div>

                                            <!-- Ngày hết hạn hợp đồng -->
                                            <div class="col-md-6">

                                                <label class="form-label fw-semibold">
                                                    Ngày hết hạn hợp đồng
                                                </label>

                                                <input type="date" class="form-control rounded-4"
                                                    v-model="formData.end_date"
                                                    :class="{ 'is-invalid': errors.end_date }">
                                                <div class="invalid-feedback" v-if="errors.end_date">
                                                    {{ errors.end_date[0] }}
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </transition>

                        <!-- Footer -->
                        <div class="d-flex justify-content-end gap-3 mt-3 pt-3 border-top">

                            <button type="button" class="btn btn-light border rounded-pill px-4 fw-semibold"
                                @click="emit('close')" v-if="currentStep === 1">
                                Cancel
                            </button>

                            <button type="button" class="btn btn-light border rounded-pill px-4 fw-semibold"
                                @click="prevStep" v-if="currentStep > 1">
                                <i class="fa-solid fa-arrow-left me-2"></i>
                                Quay lại
                            </button>

                            <button type="button" class="btn btn-success rounded-pill px-4 fw-semibold shadow-sm"
                                @click="nextStep" v-if="currentStep < 3">
                                Tiếp
                                <i class="fa-solid fa-arrow-right ms-2"></i>
                            </button>

                            <button type="button" class="btn btn-success rounded-pill px-4 fw-semibold shadow-sm"
                                @click="saveEmployee" v-if="currentStep === 3">
                                <i class="fa-solid fa-check me-2"></i>
                                Lưu nhân viên
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>
</template>
<script setup>
import { reactive, onMounted, ref } from 'vue'
import api from '../../../../axios'

const emit = defineEmits([
    'close',
    'update'
])

// Wizard control
const currentStep = ref(1)

// Data select option
const departments = ref([])
const positions = ref([])
const roles = ref([])
const employees = ref([])

const errors = ref({})

// Form Data
const formData = reactive({
    emp_code: '',
    fullname: '',
    birthday: '',
    luongCoBan: '',
    phuCapChucVu: '',
    phuCapSinhHoat: '',
    start_date: '',
    end_date: '',
    sign_date: '',
    sex: '',
    email: '',
    password: '',
    phone: '',
    hire_date: '',
    status: 1,
    manager_id: '',
    depart_id: '',
    pos_id: '',
    role_id: '',
})

const getRole = async () => {
    const gr = await api.get('role')
    roles.value = gr.data
}
const getDepart = async () => {
    const gd = await api.get('department')
    departments.value = gd.data.department
}
const getPos = async () => {
    const gp = await api.get('position')
    positions.value = gp.data
}
onMounted(() => {
    getRole()
    getDepart()
    getPos()
}
)

// ===== Validate theo từng bước (chỉ validate phía client để điều hướng wizard) =====
const requiredMessage = 'Trường này không được để trống'

const validateStep1 = () => {
    const stepErrors = {}
    const fields = ['emp_code', 'fullname', 'birthday', 'sex', 'phone']

    fields.forEach((field) => {
        if (!formData[field]) {
            stepErrors[field] = [requiredMessage]
        }
    })

    errors.value = stepErrors
    return Object.keys(stepErrors).length === 0
}

const validateStep2 = () => {
    const stepErrors = {}
    const fields = ['email', 'password', 'hire_date', 'depart_id', 'pos_id', 'role_id']

    fields.forEach((field) => {
        if (!formData[field]) {
            stepErrors[field] = [requiredMessage]
        }
    })

    errors.value = stepErrors
    return Object.keys(stepErrors).length === 0
}

const validateStep3 = () => {
    const stepErrors = {}
    const fields = ['luongCoBan', 'insurance_salary', 'phuCapChucVu', 'phuCapSinhHoat', 'start_date', 'end_date']

    fields.forEach((field) => {
        if (formData[field] === '' || formData[field] === null || formData[field] === undefined) {
            stepErrors[field] = [requiredMessage]
        }
    })

    errors.value = stepErrors
    return Object.keys(stepErrors).length === 0
}

const nextStep = () => {
    let isValid = false

    if (currentStep.value === 1) {
        isValid = validateStep1()
    } else if (currentStep.value === 2) {
        isValid = validateStep2()
    }

    if (isValid) {
        errors.value = {}
        currentStep.value++
    }
}

const prevStep = () => {
    errors.value = {}
    currentStep.value--
}

const saveEmployee = async () => {
    if (!validateStep3()) {
        return
    }

    try {
        await api.post(`employee/create-employee`, formData)
        emit('close')
        emit('update')
    } catch (error) {
        errors.value = error.response?.data?.errors || {}
    }

}
</script>
<style scoped>
.custom-modal-width {
    max-width: 1200px !important;

}

.custom-modal {
    background: rgba(15, 23, 42, 0.55);
    backdrop-filter: blur(4px);
}

.modal-dialog {
    max-width: 880px;
}

.modal-content {
    max-height: 92vh;
    overflow-y: auto;
    border-radius: 24px;
}

.card {
    transition: .2s ease;
}

.card:hover {
    transform: translateY(-1px);
}

.card-body {
    padding: 20px;
}

.form-control,
.form-select {
    height: 44px;
    border-radius: 14px;
    border: 1px solid #dbe2ea;
    font-size: 14px;
    transition: .2s;
}

.form-control:focus,
.form-select:focus {
    border-color: #198754;
    box-shadow: 0 0 0 .15rem rgba(25, 135, 84, .15);
}

.form-label {
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 6px;
    color: #334155;
}

h6 {
    font-size: 15px;
    color: #0f172a;
}

.mb-3 {
    margin-bottom: 16px !important;
}

.btn {
    height: 42px;
    font-size: 14px;
}

.btn-success {
    background: rgb(15, 118, 110);
    border: none;
    transition: .2s;
}

.btn-success:hover {
    background: rgb(13, 148, 136);
    transform: translateY(-1px);
}

/* ===================== WIZARD STEPPER ===================== */
.wizard-steps {
    display: flex;
    align-items: flex-start;
    justify-content: center;
    padding: 8px 16px 0;
}

.wizard-step {
    display: flex;
    flex-direction: column;
    align-items: center;
    flex: 0 0 auto;
    width: 160px;
    text-align: center;
}

.wizard-circle {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: #e9ecef;
    color: #6c757d;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 14px;
    border: 2px solid #e9ecef;
    transition: all .25s ease;
}

.wizard-title {
    margin-top: 8px;
    font-size: 13px;
    font-weight: 600;
    color: #94a3b8;
    transition: color .25s ease;
}

.wizard-step.active .wizard-circle {
    background: #198754;
    border-color: #198754;
    color: #fff;
    width: 42px;
    height: 42px;
    font-size: 16px;
    box-shadow: 0 0 0 4px rgba(25, 135, 84, .15);
}

.wizard-step.active .wizard-title {
    color: #198754;
    font-weight: 700;
}

.wizard-step.done .wizard-circle {
    background: #198754;
    border-color: #198754;
    color: #fff;
}

.wizard-step.done .wizard-title {
    color: #198754;
}

.wizard-line {
    flex: 1 1 auto;
    height: 2px;
    background: #e9ecef;
    margin-top: 18px;
    max-width: 120px;
    transition: background .3s ease;
}

.wizard-line.filled {
    background: #198754;
}

/* ===================== STEP TRANSITION ===================== */
.step-fade-enter-active,
.step-fade-leave-active {
    transition: opacity .2s ease, transform .2s ease;
}

.step-fade-enter-from {
    opacity: 0;
    transform: translateX(16px);
}

.step-fade-leave-to {
    opacity: 0;
    transform: translateX(-16px);
}
</style>