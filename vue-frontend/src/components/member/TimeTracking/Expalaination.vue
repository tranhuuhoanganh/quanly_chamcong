<template>

    <div class="modal-overlay">

        <div class="modal-box">

            <div class="d-flex justify-content-between mb-3">
                <h5>Expalaination</h5>

                <button class="btn-close" @click="emit('close')"></button>
            </div>

            <form @submit.prevent="saveExpalaination" novalidate>
                <div class="mb-3">
                    <div class="d-flex align-items-center mb-3">
                        <span class="fw-semibold text-secondary me-2">
                            Ngày giải trình:
                        </span>

                        <span class="fw-semibold text-dark">
                            {{ new Date(Expalaination.working_day.work_date).toLocaleDateString('vi-VN') }}
                        </span>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Loại giải trình</label>
                    <select class="form-control" v-model="formData.type">
                        <option value="" disabled>
                            Chọn loại giải trình
                        </option>
                        <option :value="1">
                            Đi làm muộn
                        </option>
                        <option :value="0">
                            Về sớm
                        </option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Lý do giải trình </label>
                    <input type="text" class="form-control" v-model="formData.reason">
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn text-white rounded-pill px-4 fw-semibold shadow-sm save-btn">
                        <i class="fa-solid fa-check me-2"></i>
                        Save
                    </button>
                </div>
            </form>

        </div>

    </div>

</template>

<script setup>
import { reactive, ref } from 'vue';
import api from '../../../axios';
import { useToast } from 'vue-toastification';

const props = defineProps({
    Expalaination: Object
})
const toast = useToast()
const formData = reactive({
    create_date: '',
    reason: '',
    type: '',
    time_entry_id: null
})
const errors = ref({})
const emit = defineEmits([
    'close',
    'update'
])
const saveExpalaination = async () => {
    try {
        formData.create_date = props.Expalaination.working_day.work_date
        formData.time_entry_id = props.Expalaination.time_entry_id

        const response = await api.post(`attendance/create-expalaination`, formData)
        emit('close')
        emit('update')
        toast.success(response.data.message)
    } catch (error) {
        errors.value = error.response?.data?.errors || {}
    }
}

</script>

<style scoped>
.modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.4);

    display: flex;
    justify-content: center;
    align-items: center;

    z-index: 999;
}

.modal-box {
    width: 400px;
    background: white;
    padding: 24px;
    border-radius: 16px;
}

.save-btn {
    background: rgb(15, 118, 110);
    border: none;
    transition: .2s;
}

.save-btn:hover {
    background: rgb(13, 148, 136);
    transform: translateY(-1px);
}
</style>