<template>

    <div class="modal-overlay">

        <div class="modal-box">

            <div class="d-flex justify-content-between mb-3">
                <h5>Create pos</h5>

                <button class="btn-close" @click="emit('close')"></button>
            </div>

            <form @submit.prevent="savepos" novalidate>
                <div class="mb-3">
                    <label>Mã chức vụ</label>
                    <input type="text" class="form-control" v-model="FormData.pos_code">
                </div>
                <div class="mb-3">
                    <label>Tên chức vụ</label>
                    <input type="text" class="form-control" v-model="FormData.pos_name">
                </div>
                <div class="mb-3">
                    <label>Level chức vụ</label>
                    <input type="number" class="form-control" v-model="FormData.level">
                </div>
                <div class="mb-3">
                    <label>Ghi chú</label>
                    <input type="text" class="form-control" v-model="FormData.pos_description">
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
import { reactive } from 'vue';
import api from '../../../../axios';
const FormData = reactive({
    pos_code: '',
    pos_name: '',
    level: '',
    pos_description: '',
})
const emit = defineEmits([
    'close',
    'update'
])

const savepos = async () =>{
    try {
        await api.post(`position/create-pos`,FormData)
        emit('close')
        emit('update')
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