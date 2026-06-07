<template>
    <div class="modal fade show d-block bg-dark bg-opacity-50">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content rounded-4 border-0">

                <div class="modal-header border-0">
                    <h5 class="modal-title fw-semibold">
                        Delete role
                    </h5>

                    <button
                        class="btn-close"
                        @click="emit('close')">
                    </button>
                </div>

                <div class="modal-body text-secondary">
                    Bạn có chắc chắn muốn xóa vai trò này?
                </div>

                <div class="modal-footer border-0">

                    <button
                        class="btn btn-light rounded-pill px-4"
                        @click="emit('close')">
                        Cancel
                    </button>

                    <button
                        class="btn btn-danger rounded-pill px-4"
                        @click="deleteRole">
                        Delete
                    </button>

                </div>

            </div>

        </div>

    </div>
</template>
<script setup>
import api from '../../../../axios';

const props = defineProps({
    role: Number
})

const emit = defineEmits([
    'close',
    'update'
])
const deleteRole = async () =>{
    try {
        await api.delete(`role/delete/${props.role}`)
        emit('close')
        emit('update')
    } catch (error) {
        console.log(error)
    }
}
</script>
