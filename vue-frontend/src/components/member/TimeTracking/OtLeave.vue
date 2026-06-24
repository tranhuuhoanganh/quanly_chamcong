<template>

    <div class="modal-overlay">

        <div class="modal-box">

            <div class="d-flex justify-content-between mb-3">
                <h5>Ot</h5>

                <button class="btn-close" @click="emit('close')"></button>
            </div>

            <form @submit.prevent="saveOtLeave" novalidate>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold mb-1">Từ ngày</label>
                        <input v-model="formData.start_time" type="time" class="form-control custom-input-sm" />
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold mb-1">Đến ngày</label>
                        <input v-model="formData.end_time" type="time" class="form-control custom-input-sm" />
                    </div>
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

import { ref, reactive } from 'vue';
import api from '../../../axios';
import { useToast } from 'vue-toastification';
const props = defineProps({
    Ot : Number
})
const toast = useToast()
const formData = reactive({
    start_time: '',
    end_time: '',
    type_id: props.Ot,
    reason: '',
})
const emit = defineEmits([
    'close'
])
const saveOtLeave = async() => {
    try {
        const res = await api.post(`attendance/create-ot`,formData)
        toast.success(res.data.message)
    } catch (error) {
        toast.error(error.response.data.message)

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