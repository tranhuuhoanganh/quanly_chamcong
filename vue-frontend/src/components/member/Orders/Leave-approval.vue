<template>
    <div>
        <!-- Table -->
        <div class="card border-0 shadow-sm overflow-hidden"
            style="border-radius:15px;border-top:3px solid #0f766e !important;">

            <div class="card-body p-0">

                <table class="table align-middle mb-0">

                    <thead style="background:#f8f9fa;">
                        <tr>
                            <th class="py-3 ps-4">STT</th>
                            <th class="py-3">Ngày giải trình</th>
                            <th class="py-3">Nghỉ từ ngày</th>
                            <th class="py-3">Nghỉ đến ngày</th>

                            <th class="py-3">Loại</th>
                            <th class="py-3">Trạng thái</th>
                            <th class="py-3 text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr v-for="(leave, index) in pagination.items" :key="leave.request_id">

                            <td class="ps-4">
                                {{ index + 1 }}
                            </td>

                            <td>
                                {{ new Date(leave.create_date).toLocaleDateString('vi-VN') }}
                            </td>
                            <td>
                                {{ new Date(leave.start_date).toLocaleDateString('vi-VN') }}
                            </td>
                            <td>
                                {{ new Date(leave.end_date).toLocaleDateString('vi-VN') }}
                            </td>

                            <td>
                                {{ leave.leave_type.type_name }}
                            </td>

                            <td>
                                {{ leave.status_request == 0 ? 'Chưa duyệt' : 'Đã duyệt' }}
                            </td>

                            <td class="text-center" v-if="leave.status_request == 0">
                                <button class="btn btn-sm btn-light border me-2" style="border-radius:10px;"
                                    @click="openEditModal(leave)">
                                    <i class="fa-solid fa-list-check"></i>
                                </button>
                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>
            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center px-4 py-3 border-top">
                <small class="text-muted">
                    Hiển thị {{ pagination.start + 1 }}–{{ pagination.end }} / {{ leaves.length }} bản ghi
                </small>
                <nav>
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item" :class="{ disabled: currentPage === 1 }">
                            <button class="page-link" @click="changePage(currentPage - 1)">
                                <i class="fa-solid fa-chevron-left"></i>
                            </button>
                        </li>
                        <li v-for="page in totalPages" :key="page" class="page-item"
                            :class="{ active: page === currentPage }">
                            <button class="page-link" @click="changePage(page)">{{ page }}</button>
                        </li>
                        <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                            <button class="page-link" @click="changePage(currentPage + 1)">
                                <i class="fa-solid fa-chevron-right"></i>
                            </button>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <LeaveDetail v-if="showDetailleave" :leave="selectDetailleave"
            @close="showDetailleave = false" @update="getleave" />
    </div>
</template>

<script setup>
import { reactive, ref, onMounted } from 'vue'
import api from '../../../axios.js'
import { useToast } from 'vue-toastification'
import { usePagination } from '../../../usePagination.js'
import LeaveDetail from './Leave-detail.vue'
const formData = reactive({
    date: ''
})
const toast = useToast()
const showDetailleave = ref(false)
const leaves = ref([])
const { currentPage, totalPages, pagination, changePage, reset } = usePagination(leaves, 5)

const getleave = async () => {
    const res = await api.get(`leave/get-leave`)
    leaves.value = res.data
    reset()
}

const selectDetailleave = ref(null)
const openEditModal = (leave) => {
    selectDetailleave.value = leave
    showDetailleave.value = true
}
onMounted(() => {
    getleave()
}
)
</script>

<style scoped>
.inactive-row td {
    background: #bbbec1 !important;
}
</style>