<template>
    <div class="modal fade show d-block custom-modal" tabindex="-1">

        <div class="modal-dialog modal-lg modal-dialog-centered">

            <div class="modal-content border-0 rounded-4 shadow-lg">

                <!-- Header -->
                <div class="modal-header border-0 px-4 pt-3 pb-2">

                    <div>
                        <h5 class="fw-bold mb-1 text-dark">
                            Expalaination Detail
                        </h5>


                    </div>

                    <button type="button" class="btn-close" @click="emit('close')">
                    </button>

                </div>

                <!-- Body -->
                <div class="modal-body px-4 pt-2">

                    <form novalidate>

                        <div class="mb-3">
                            <div class="d-flex align-items-center ">
                                <span class="fw-semibold text-secondary me-2">
                                    Họ và tên:
                                </span>

                                <span class="fw-semibold text-dark">
                                    {{ user.fullname }}

                                </span>
                            </div>
                            <div class="d-flex align-items-center ">
                                <span class="fw-semibold text-secondary me-2">
                                    Mã nhân viên:
                                </span>

                                <span class="fw-semibold text-dark">
                                    {{ user.emp_code }}

                                </span>
                            </div>
                            <div class="d-flex align-items-center ">
                                <span class="fw-semibold text-secondary me-2">
                                    Email :
                                </span>

                                <span class="fw-semibold text-dark">
                                    {{ user.email }}
                                </span>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <span class="fw-semibold text-secondary me-2">
                                    Ngày giải trình:
                                </span>

                                <span class="fw-semibold text-dark">
                                    {{ new Date(props.expalaination.create_date).toLocaleDateString('vi-VN') }}
                                </span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Loại giải trình</label>
                            <select class="form-control" v-model="formData.type" disabled>
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
                            <input type="text" class="form-control" v-model="formData.reason" readonly>
                        </div>

                        <!-- Footer -->
                        <div class="d-flex justify-content-end gap-3 mt-4 pt-3 border-top">

                            <button type="submit" class="btn btn-danger rounded-pill px-4 fw-semibold shadow-sm">
                                <i class="fa-solid fa-xmark me-2"></i>
                                Từ chối
                            </button>
                            <button type="submit" class="btn btn-success rounded-pill px-4 fw-semibold shadow-sm">
                                <i class="fa-solid fa-check me-2"></i>
                                Phê duyệt
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
import api from '../../../axios.js'
import { useToast } from 'vue-toastification'
const toast = useToast()
const user = ref([])
const props = defineProps({
    expalaination: Object
})
const emit = defineEmits([
    'close',
    'update'
])

const formData = reactive({
    reason: '',
    type: ''
})

const saveExpalaination = async () => {
    try {
        const res = await api.put(`expalaination/update/${props.expalaination.explain_id}`, formData)
        emit('close')
        emit('update')
        toast.success(res.data.message)
    } catch (error) {
        toast.error(error.response.data.message)
    }
}
const getUser = async () => {
    const res = await api.get(`expalaination/get-user`, {
        params: {
            time_entry_id: props.expalaination.time_entry_id
        }
    })
    user.value = res.data

}
onMounted(async () => {
    Object.assign(formData, {
        reason: props.expalaination.reason,
        type: props.expalaination.type,
    });
    getUser();
});
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