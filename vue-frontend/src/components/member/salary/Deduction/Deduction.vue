    <template>
        <div>

            <!-- Title -->
            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>
                    <button class="btn rounded-pill px-4" style="background: #0f766e; color: #f8f9fa;"
                        @click="openCreateModal">
                        <i class="fa-solid fa-plus me-2"></i>
                        Thêm mới
                    </button>
                </div>

            </div>

            <!-- Table -->
            <div class="card border-0 shadow-sm overflow-hidden"
                style="border-radius:15px;border-top:3px solid #0f766e !important;">

                <div class="card-body p-0">

                    <table class="table align-middle mb-0">

                        <thead style="background:#f8f9fa;">
                            <tr>
                                <th class="py-3 ps-4">STT</th>
                                <th class="py-3">Nhân viên</th>
                                <th class="py-3">Loại</th>
                                <th class="py-3">Tiền</th>
                                <th class="py-3">Ngày</th>
                                <th class="py-3 text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr v-for="(deduction, index) in Deductions" :key="deduction.deduction_id"
                                :class="{ 'inactive-row': deduction.status == 0 }">

                                <td class="ps-4">
                                    {{ index + 1 }}
                                </td>

                                <td>
                                    {{ deduction.user.name }}
                                </td>

                                <td>
                                    {{ deduction.deduction_type.name }}
                                </td>

                                <td>
                                    {{ Number(deduction.amount).toLocaleString('en-US') }}                                
                                </td>

                                <td>
                                    {{ new Date(deduction.deduction_date).toLocaleDateString('vi-VN') }}
                                </td>
                                <td class="text-center">

                                    <button class="btn btn-sm btn-light border me-2" style="border-radius:10px;"
                                        @click="openEditModal(deduction)">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </button>

                                    <button class="btn btn-sm btn-light border text-danger" style="border-radius:10px;"
                                        @click="openDeleteModal(deduction)">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>
           <BoxPopCreateDeduction v-if="showCreateDeduction" @close="showCreateDeduction = false" @update="getDeduction" />
           <BoxPopEditDeduction v-if="showEditDeduction" :deduction="selectedEditDeduction" @close="showEditDeduction = false" @update="getDeduction" />

        </div>
    </template>

<script setup>
import { ref, onMounted } from 'vue';
import api from '../../../../axios';
import BoxPopCreateDeduction from './BoxPopCreateDeduction.vue';
import BoxPopEditDeduction from './BoxPopEditDeduction.vue';
const Deductions = ref([])
const showEditDeduction = ref(false)
const showCreateDeduction = ref(false)

const getDeduction = async () => {
        const res = await api.get(`deduction/get-deduction`)
        Deductions.value = res.data
}
onMounted(() => {
    getDeduction()
})
const openCreateModal = () => {
    showCreateDeduction.value = true
}
const selectedEditDeduction = ref(null)
const openEditModal = (deduction) => {
    selectedEditDeduction.value = deduction
    showEditDeduction.value = true
}
</script>

<style scoped>
.inactive-row td {
    background: #bbbec1 !important;
}
</style>