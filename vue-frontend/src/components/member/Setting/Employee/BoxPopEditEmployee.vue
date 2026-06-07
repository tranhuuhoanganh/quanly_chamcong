<template>
    <div class="modal fade show d-block custom-modal" tabindex="-1">

        <div class="modal-dialog modal-xl modal-dialog-centered">

            <div class="modal-content border-0 rounded-4 shadow-lg">

                <!-- Header -->
                <div class="modal-header border-0 px-4 pt-3 pb-2">

                    <div>
                        <h5 class="fw-bold mb-1 text-dark">
                            Edit Employee
                        </h5>

                        <p class="text-secondary mb-0 small">
                            Sửa thông tin nhân viên trong hệ thống
                        </p>
                    </div>

                    <button type="button" class="btn-close" @click="emit('close')"></button>

                </div>

                <!-- Body -->
                <div class="modal-body px-4 pt-2">

                    <form @submit.prevent="saveEmployee" novalidate>

                        <div class="row g-3">

                            <!-- LEFT -->
                            <div class="col-lg-6">

                                <div class="card border-0 rounded-4 shadow-sm bg-body-tertiary h-100">

                                    <div class="card-body">

                                        <h6 class="fw-bold d-flex align-items-center gap-2 mb-3">
                                            <i class="fa-solid fa-user text-success"></i>
                                            Thông tin cá nhân
                                        </h6>

                                        <!-- Employee Code -->
                                        <div class="mb-3">

                                            <label class="form-label fw-semibold">
                                                Mã nhân viên
                                            </label>

                                            <input type="text" class="form-control rounded-4"
                                                v-model="formData.emp_code" :class="{ 'is-invalid': errors.emp_code }">

                                            <div class="invalid-feedback" v-if="errors.emp_code">
                                                {{ errors.emp_code[0] }}
                                            </div>
                                        </div>

                                        <!-- Fullname -->
                                        <div class="mb-3">

                                            <label class="form-label fw-semibold">
                                                Họ và tên
                                            </label>

                                            <input type="text" class="form-control rounded-4"
                                                v-model="formData.fullname" :class="{ 'is-invalid': errors.fullname }">

                                            <div class="invalid-feedback" v-if="errors.fullname">
                                                {{ errors.fullname[0] }}
                                            </div>

                                        </div>

                                        <!-- Birthday -->
                                        <div class="mb-3">

                                            <label class="form-label fw-semibold">
                                                Ngày sinh
                                            </label>

                                            <input type="date" class="form-control rounded-4"
                                                v-model="formData.birthday" :class="{ 'is-invalid': errors.birthday }">

                                            <div class="invalid-feedback" v-if="errors.birthday">
                                                {{ errors.birthday[0] }}
                                            </div>

                                        </div>

                                        <!-- Gender -->
                                        <div class="mb-3">

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
                                        <div class="mb-0">

                                            <label class="form-label fw-semibold">
                                                Số điện thoại
                                            </label>

                                            <input type="text" class="form-control rounded-4" v-model="formData.phone"
                                                :class="{ 'is-invalid': errors.phone }">

                                            <div class="invalid-feedback" v-if="errors.phone">
                                                {{ errors.phone[0] }}
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <!-- RIGHT -->
                            <div class="col-lg-6">

                                <div class="card border-0 rounded-4 shadow-sm bg-body-tertiary h-100">

                                    <div class="card-body">

                                        <h6 class="fw-bold d-flex align-items-center gap-2 mb-3">
                                            <i class="fa-solid fa-briefcase text-success"></i>
                                            Thông tin công việc
                                        </h6>

                                        <!-- Email -->
                                        <div class="mb-3">

                                            <label class="form-label fw-semibold">
                                                Email
                                            </label>

                                            <input type="email" class="form-control rounded-4" v-model="formData.email"
                                                :class="{ 'is-invalid': errors.email }">

                                            <div class="invalid-feedback" v-if="errors.email">
                                                {{ errors.email[0] }}
                                            </div>

                                        </div>

                                        <!-- Password -->
                                        <div class="mb-3">

                                            <label class="form-label fw-semibold">
                                                Password
                                            </label>

                                            <input type="password" class="form-control rounded-4"
                                                v-model="formData.password" :class="{ 'is-invalid': errors.password }">

                                            <div class="invalid-feedback" v-if="errors.password">
                                                {{ errors.password[0] }}
                                            </div>

                                        </div>

                                        <!-- Hire Date -->
                                        <div class="mb-3">

                                            <label class="form-label fw-semibold">
                                                Ngày vào làm
                                            </label>

                                            <input type="date" class="form-control rounded-4"
                                                v-model="formData.hire_date">
                                            <div class="invalid-feedback" v-if="errors.email">{{ errors.email[0] }}
                                            </div>

                                        </div>

                                        <!-- Department -->
                                        <div class="mb-3">

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
                                        <div class="mb-3">

                                            <label class="form-label fw-semibold">
                                                Chức vụ
                                            </label>

                                            <select class="form-select rounded-4" v-model="formData.pos_id"
                                                :class="{ 'is-invalid': errors.pos_id }">
                                                <option value="">
                                                    -- Chọn chức vụ --
                                                </option>
                                                <option v-for="pos in positions" :key="pos.pos_id" :value="pos.pos_id">
                                                    {{ pos.pos_name }}</option>

                                            </select>
                                            <div class="invalid-feedback" v-if="errors.pos_id">
                                                {{ errors.pos_id[0] }}
                                            </div>
                                        </div>

                                        <!-- Role -->
                                        <div class="mb-0">

                                            <label class="form-label fw-semibold">
                                                Vai trò
                                            </label>

                                            <select class="form-select rounded-4" v-model="formData.role_id"
                                                :class="{ 'is-invalid': errors.role_id }">
                                                <option value="">
                                                    -- Chọn vai trò --
                                                </option>
                                                <option v-for="role in roles" :key="role.role_id" :value="role.role_id">
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

                        <!-- Footer -->
                        <div class="d-flex justify-content-end gap-3 mt-3 pt-3 border-top">

                            <button type="button" class="btn btn-light border rounded-pill px-4 fw-semibold"
                                @click="emit('close')">
                                Cancel
                            </button>

                            <button type="submit" class="btn btn-success rounded-pill px-4 fw-semibold shadow-sm">
                                <i class="fa-solid fa-check me-2"></i>
                                Save
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

const props = defineProps({
    employee: Object
})

const emit = defineEmits([
    'close',
    'update'
])

// Data select option
const departments = ref([])
const positions = ref([])
const roles = ref([])

const errors = ref({})

// Form Data
const formData = reactive({
    emp_code: '',
    fullname: '',
    birthday: '',
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



onMounted(async () => {
    // Gán fields đơn giản từ props trước
    Object.assign(formData, {
        emp_code: props.employee.emp_code,
        fullname: props.employee.fullname,
        birthday: props.employee.birthday,
        sex: props.employee.sex,
        email: props.employee.email,
        phone: props.employee.phone,
        hire_date: props.employee.hire_date,
    })

    // Fetch API song song
    const [gr, gd, gp] = await Promise.all([
        api.get('role'),
        api.get('department'),
        api.get('position')
    ])

    roles.value = gr.data
    departments.value = gd.data.department
    positions.value = gp.data

    // Gán select options sau khi có data
    if (props.employee?.role) formData.role_id = props.employee.role.role_id
    if (props.employee?.department) formData.depart_id = props.employee.department.depart_id
    if (props.employee?.position) formData.pos_id = props.employee.position.pos_id
})

const saveEmployee = async () => {
    try {
        await api.put(`employee/update/${props.employee.id}`, formData)
        emit('close')
        emit('update')
    } catch (error) {
        errors.value = error.response?.data?.errors || {}
    }

}
</script>
<style scoped>
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
</style>
