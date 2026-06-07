<template>

    <div class="modal-overlay">

        <div class="modal-box">

            <div class="d-flex justify-content-between mb-3">
                <h5>Edit Department</h5>

                <button class="btn-close" @click="emit('close')"></button>
            </div>

            <div class="mb-3">
                <label>Mã phòng ban</label>

                <input type="text" class="form-control" v-model="FormData.role_name">
            </div>
            <div class="mb-3">
                <label>Ghi chú</label>

                <input type="text" class="form-control" v-model="FormData.role_description">
            </div>
            <div class="d-flex justify-content-end">
                    <button class="btn text-white rounded-pill px-4 fw-semibold shadow-sm save-btn"
                        @click="saveRole">
                        <i class="fa-solid fa-check me-2"></i>
                        Save
                    </button>
                </div>

        </div>

    </div>

</template>

<script setup>
import { reactive, watch  } from 'vue';
import api from '../../../../axios';

const props  = defineProps({
    role:Object
})
const FormData = reactive({
    role_name: '',
    role_description: '',
})
const emit = defineEmits([
    'close',
    'update'
])

watch(
    () => props.role,
    (newRole) => {
        if (newRole) {
            FormData.role_name = newRole.role_name
            FormData.role_description = newRole.role_description
        }
    },
    { immediate: true }
)   
const saveRole = async () =>{
    try {
        await api.put(`role/update/${props.role.role_id}`,FormData)
        emit('close')
        emit('update')
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