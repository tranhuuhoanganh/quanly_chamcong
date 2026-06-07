<template>

    <div class="modal-overlay">

        <div class="modal-box">

            <div class="d-flex justify-content-between mb-3">
                <h5>Edit Department</h5>

                <button class="btn-close" @click="emit('close')"></button>
            </div>

            <div class="mb-3">
                <label>Mã phòng ban</label>

                <input type="text" class="form-control" v-model="FormData.depart_code">
            </div>

            <div class="mb-3">
                <label>Tên phòng ban</label>

                <input type="text" class="form-control" v-model="FormData.depart_name">
            </div>
            <div class="mb-3">
                <label>Ghi chú</label>

                <input type="text" class="form-control" v-model="FormData.depart_description">
            </div>
            <div class="mb-3">
                <label>Trưởng phòng</label>

                <select class="form-control" v-model="FormData.manager_id">

                    <option value="">-- Chọn trưởng phòng --</option>

                    <option v-for="user in getNameManagers" :key="user.id" :value="user.id">
                        {{ user.name }}-{{ user.email }}
                    </option>

                </select>
            </div>
            <div class="d-flex justify-content-end">
                    <button class="btn text-white rounded-pill px-4 fw-semibold shadow-sm save-btn"
                        @click="saveDepartment">

                        <i class="fa-solid fa-check me-2"></i>
                        Save

                    </button>
                </div>

        </div>

    </div>

</template>

<script setup>
import { reactive, ref, watch, onMounted } from 'vue';
import api from '../../../../axios';
const getNameManagers = ref([])
const props = defineProps({
    department: Object
})
const FormData = reactive({
    depart_name: '',
    depart_code: '',
    depart_description: '',
    manager_id: ''
})
const emit = defineEmits([
    'close',
    'update'
])

onMounted(async () => {
    // Gán fields từ props trước
    if (props.department) {
        Object.assign(FormData, {
            depart_name: props.department.depart_name,
            depart_code: props.department.depart_code,
            depart_description: props.department.depart_description,
        })
    }

    // Fetch API
    try {
        const res = await api.get('get-user')
        getNameManagers.value = res.data

        if (props.department?.manager) {
            FormData.manager_id = props.department.manager.id
        }
    } catch (error) {
        console.log(error)
    }
})

const saveDepartment = async () => {
    try {
        await api.put(`department/update/${props.department.depart_id}`, FormData)
        emit('update')
        emit('close')
    } catch (error) {
        console.log(error)
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