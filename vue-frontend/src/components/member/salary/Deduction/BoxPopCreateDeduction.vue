<template>

    <div class="modal-overlay">

        <div class="modal-box">

            <div class="d-flex justify-content-between mb-3">
                <h5>Create deduction</h5>

                <button class="btn-close" @click="emit('close')"></button>
            </div>

            <form @submit.prevent="saveDeduction" novalidate>
                <div class="mb-3">
                    <label>Nhân viên</label>
                    <select class="form-control" v-model="formData.user_id">
                        <option value="">-- Chọn nhân viên --</option>
                        <option v-for="user in getUsers" :key="user.id" :value="user.id">
                            {{ user.fullname }} - {{ user.email }}
                        </option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Loại khấu trừ</label>
                    <select class="form-control" v-model="formData.deduction_type_id">
                        <option value="">-- Chọn loại khấu trừ --</option>
                        <option v-for="type in getTypes" :key="type.id" :value="type.id">
                            {{ type.name }}
                        </option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Tiền khấu trừ</label>
                    <input type="number" class="form-control" v-model="formData.amount">
                </div>
                <div class="mb-3">
                    <label>Ngày áp dụng</label>
                    <input type="date" class="form-control" v-model="formData.deduction_date">
                </div>
                <div class="mb-3">
                    <label>Ghi chú</label>
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
import { reactive, ref, onMounted } from 'vue';
import api from '../../../../axios';
const getUsers = ref([])
const getTypes = ref([])
const formData = reactive({
    amount: '',
    reason: '',
    user_id: '',
    deduction_type_id:'',
    deduction_date: ''
})
const emit = defineEmits([
    'close',
    'update'
])
const getUser = async() => {
    const res = await api.get(`get-user`)
    getUsers.value = res.data   
}
const getType = async() => {
    const res = await api.get(`deduction/get-type`)
    getTypes.value = res.data  
}

const saveDeduction = async () =>{
    try {
        await api.post(`deduction/create-deduction`,formData)
        emit('close')
        emit('update')
    } catch (error) {
        errors.value = error.response?.data?.errors || {}
    }
}
onMounted(() => {
    getUser()
    getType()
})
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