<template>
    <div class="modal fade show d-block custom-modal" tabindex="-1">

        <div class="modal-dialog modal-lg modal-dialog-centered">

            <div class="modal-content border-0 rounded-4 shadow-lg">

                <!-- Header -->
                <div class="modal-header border-0 px-4 pt-3 pb-2">

                    <div>
                        <h5 class="fw-bold mb-1 text-dark">
                            Create Working Schedule
                        </h5>


                    </div>

                    <button type="button" class="btn-close" @click="emit('close')">
                    </button>

                </div>

                <!-- Body -->
                <div class="modal-body px-4 pt-2">

                    <form @submit.prevent="saveSchedule" novalidate>

                        <!-- Ngày làm việc -->
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Ngày làm việc
                            </label>

                            <input type="date" class="form-control rounded-4" v-model="formData.work_date">

                        </div>

                        <!-- Giờ -->
                        <div class="row g-3">

                            <!-- Checkin -->
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Giờ check in
                                </label>

                                <input type="time" class="form-control rounded-4" v-model="formData.checkin_time">

                            </div>

                            <!-- Checkout -->
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Giờ check out
                                </label>

                                <input type="time" class="form-control rounded-4" v-model="formData.checkout_time">

                            </div>

                        </div>

                        <!-- Loại ngày -->
                        <div class="mt-3">

                            <label class="form-label fw-semibold">
                                Loại ngày
                            </label>

                            <select class="form-select rounded-4" v-model="formData.day_type">

                                <option value="">-- Chọn loại ngày --</option>
                                <option v-for="type in types" :key="type.type_id" :value="type.type_id">{{ type.type_name }}</option>

                            </select>


                        </div>

                        <!-- Footer -->
                        <div class="d-flex justify-content-end gap-3 mt-4 pt-3 border-top">

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
import { onMounted, reactive, ref } from 'vue'
import api from '../../../../axios'

const emit = defineEmits([
    'close',
    'update'
])
const types = ref([])
const errors = ref({})
const formData = reactive({
    work_date: '',
    checkin_time: '',
    checkout_time: '',
    day_type: '',
})

const saveSchedule = async () => {
    try {
        await api.post('working-day/create-working', formData)
        emit('update')
        emit('close')
    } catch (error) {
        errors.value = error.response.data.errors
    }
}

const getType = async() => {
    const res = await api.get(`type`)
    types.value = res.data
}
onMounted(
    () => {
        getType()
    }
)
</script>

<style scoped>
.custom-modal {
    background: rgba(15, 23, 42, 0.55);
    backdrop-filter: blur(4px);
}

.modal-dialog {
    max-width: 560px;
}

.modal-content {
    border-radius: 24px;
    overflow: hidden;
}

.modal-body {
    padding-bottom: 24px;
}

.form-control,
.form-select {
    height: 44px;
    border-radius: 14px;
    border: 1px solid #dbe2ea;
    font-size: 14px;
    transition: .2s;
}

.textarea-custom {
    height: auto !important;
    min-height: 100px;
    resize: none;
    padding-top: 12px;
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