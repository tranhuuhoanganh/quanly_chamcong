<template>
    <div class="modal fade show d-block custom-modal" tabindex="-1">

        <div class="modal-dialog modal-lg modal-dialog-centered">

            <div class="modal-content border-0 rounded-4 shadow-lg">

                <!-- Header -->
                <div class="modal-header border-0 px-4 pt-3 pb-2">

                    <div>
                        <h5 class="fw-bold mb-1 text-dark">
                            Ot Detail
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
                            <div class="d-flex align-items-center">
                                <span class="fw-semibold text-secondary me-2">
                                    Ngày giải trình:
                                </span>

                                <span class="fw-semibold text-dark">
                                    {{ new Date(props.Ot.ot_date).toLocaleDateString('vi-VN') }}
                                </span>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <span class="fw-semibold text-secondary me-2">
                                    Loại:
                                </span>
                                <span class="fw-semibold text-dark">
                                    {{ props.Ot.type.type_name }}
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold mb-1">Giờ bắt đầu</label>
                                <input v-model="formData.start_time" type="time" class="form-control custom-input-sm"
                                    readonly />
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold mb-1">Giờ kết thúc</label>
                                <input v-model="formData.end_time" type="time" class="form-control custom-input-sm"
                                    readonly />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label>Lý do giải trình </label>
                            <input type="text" class="form-control" v-model="formData.reason" readonly>
                        </div>


                        <!-- Footer -->
                        <div class="mt-4 pt-3 border-top">

                            <div class="mb-3">
                                <label class="fw-semibold">Ghi chú người duyệt</label>
                                <input type="text" class="form-control border-primary shadow-sm bg-light"
                                    v-model="formData.ghi_Chu">
                            </div>

                            <div class="d-flex justify-content-end gap-3">

                                <button type="button" class="btn btn-danger rounded-pill px-4 fw-semibold shadow-sm"
                                    @click="rejectOt">
                                    <i class="fa-solid fa-xmark me-2"></i>
                                    Từ chối
                                </button>

                                <button type="button" class="btn btn-success rounded-pill px-4 fw-semibold shadow-sm"
                                    @click="approveOt">
                                    <i class="fa-solid fa-check me-2"></i>
                                    Phê duyệt
                                </button>

                            </div>

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
    Ot: Object
})
const emit = defineEmits([
    'close',
    'update'
])

const formData = reactive({
    reason: '',
    start_time: '',
    end_time: '',
    type_name: '',
})

const rejectOt = async () => {
    try {
        const res = await api.post('ot/reject-ot', { ot_id: props.Ot.ot_id,ghi_chu:formData.ghi_Chu })
        toast.success(res.data.message)
        emit('close')
        emit('update')
    } catch (error) {
        toast.error(error.response.data.message)
    }
}
const approveOt = async () => {
    try {
        const res = await api.post('ot/approve-ot', { ot_id: props.Ot.ot_id,ghi_Chu:formData.ghi_Chu })
        toast.success(res.data.message)
        emit('close')
        emit('update')
    } catch (error) {
        toast.error(error.response.data.message)
    }
}
const getUser = async () => {
    const res = await api.get(`ot/get-user`, {
        params: {
            user_id: props.Ot.user_id
        }
    })
    user.value = res.data
}
onMounted(async () => {
    Object.assign(formData, {
        reason: props.Ot.reason,
        start_time: props.Ot.start_time?.split('T')[0],
        end_time: props.Ot.end_time?.split('T')[0],
        type_name: props.Ot.type.type_name,

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