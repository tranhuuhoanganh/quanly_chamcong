<template>

    <div class="modal-overlay">

        <div class="modal-box">

            <div class="d-flex justify-content-between mb-3">
                <h5>Edit bonus</h5>

                <button class="btn-close" @click="emit('close')"></button>
            </div>

            <form @submit.prevent="saveBonus" novalidate>
                <div class="mb-3">
                    <label>Nhân viên</label>
                    <select class="form-control" v-model.number="formData.user_id">
                        <option value="">-- Chọn nhân viên --</option>

                        <option v-for="user in getUsers" :key="user.id" :value="user.id">
                            {{ user.name }}-{{ user.email }}
                        </option>

                    </select>
                </div>
                <div class="mb-3">
                    <label>Loại thưởng</label>
                    <select class="form-control" v-model.number="formData.bonus_type_id">
                        <option value="">-- Chọn loại thưởng --</option>

                        <option v-for="type in getTypes" :key="type.bonus_type_id" :value="type.bonus_type_id">
                            {{ type.name }}
                        </option>

                    </select>
                </div>
                <div class="mb-3">
                    <label>Tiền thưởng</label>
                    <input type="number" class="form-control" v-model="formData.amount">
                </div>
                <div class="mb-3">
                    <label>Ngày áp dụng</label>
                    <input type="month" class="form-control" v-model="formData.payroll_month">
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
import { reactive, ref, onMounted } from "vue";
import api from "../../../../axios";
import { useToast } from 'vue-toastification'
const getUsers = ref([]);
const getTypes = ref([]);
const errors = ref({})
const toast = useToast()
const Props = defineProps({
    bonus: Object,
});
   const emit = defineEmits([
    "close",
    "update"
]);

const formData = reactive({
    amount: "",
    reason: "",
    user_id: "",
    bonus_type_id: "",
    payroll_month: ""
});

onMounted(async () => {

    if (Props.bonus) {
        formData.amount = Props.bonus.amount;
        formData.reason = Props.bonus.reason ?? "";
        formData.user_id = Props.bonus.user.id;
        formData.bonus_type_id = Props.bonus.bonus_type_id;
        formData.payroll_month =
            Props.bonus.payroll_month.split("T")[0];
    }

    try {
        const res = await api.get(`get-user`);
        getUsers.value = res.data;
    } catch (error) {
        console.log(error);
    }
    try {
        const res = await api.get(`bonus/get-type`);
        getTypes.value = res.data;
    } catch (error) {
        console.log(error);
    }

});

const saveBonus = async () => {
    try {
        const res = await api.put(
            `bonus/update/${Props.bonus.bonus_id}`,
            formData
        );
        emit("update");
        emit("close");
        toast.success(res.data.message)
    } catch (error) {
        toast.error(error.response.data.message)
        errors.value = error.response.data.errors
    }

};
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