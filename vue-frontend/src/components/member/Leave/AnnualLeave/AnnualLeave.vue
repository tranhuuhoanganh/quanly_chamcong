<template>
    <div>
        <div class="row g-3">

            <div class="col">
                <div class="card-stat">
                    <div class="title">Phép được cấp</div>
                    <div class="value text-success">{{ phepNams }}</div>
                </div>
            </div>

            <div class="col">
                <div class="card-stat">
                    <div class="title">Đã sử dụng</div>
                    <div class="value text-success">{{ countAnnuals }}</div>
                </div>
            </div>

            <div class="col">
                <div class="card-stat">
                    <div class="title">Còn lại</div>
                    <div class="value text-success">{{phepNams - countAnnuals }}</div>
                </div>
            </div>

            <div class="col">
                <div class="card-stat">
                    <div class="title">Không lương</div>
                    <div class="value text-success">{{ noSalarys }}</div>
                </div>
            </div>

            <div class="col">
                <div class="card-stat">
                    <div class="title">Chờ duyệt</div>
                    <div class="value text-success">{{ awaitingApprovals }}</div>
                </div>
            </div>
        </div>
        <div class="mt-4">
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
                                    {{ statusMap[leave.status_request] || 'Không xác định' }} </td>

                                <td class="text-center">
                                    <button class="btn btn-sm btn-light border me-2" style="border-radius:10px;"
                                        @click="openEditModal(leave)">
                                        <i class="fa-solid fa-list-check"></i>
                                    </button>
                                </td>

                            </tr>


                        </tbody>

                    </table>

                </div>

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
        <AnnualLeaveDetail v-if="showDetailleave" :leave="selectDetailleave" @close="showDetailleave = false"
            @update="getleave" />
    </div>
</template>
<script setup>
import { reactive, ref, onMounted } from 'vue'
import api from '../../../../axios.js'
import { useToast } from 'vue-toastification'
import AnnualLeaveDetail from './AnnualLeaveDetail.vue'
import { usePagination } from '../../../../usePagination.js'
const formData = reactive({
    date: ''
})
const toast = useToast()
const showDetailleave = ref(false)
const leaves = ref([])
const countAnnuals = ref(0)
const noSalarys = ref(0)
const phepNams =ref(0)
const awaitingApprovals = ref(0)
const { currentPage, totalPages, pagination, changePage, reset } = usePagination(leaves, 4)

const getleave = async () => {
    const res = await api.get(`leave/get-leave-user`)
    countAnnuals.value = res.data.countAnnual
    noSalarys.value = res.data.noSalary
    phepNams.value = res.data.phepNam
    awaitingApprovals.value = res.data.awaitingApproval
    leaves.value = res.data.leave
    reset()
}

const selectDetailleave = ref(null)
const openEditModal = (leave) => {
    selectDetailleave.value = leave
    showDetailleave.value = true
}
const statusMap = {
    0: 'Chưa duyệt',
    1: 'Đã duyệt',
    2: 'Từ chối'
}

onMounted(() => {
    getleave()
}
)
</script>
<style scoped>
.card-stat {
    background: #fff;
    border-radius: 12px;
    padding: 16px;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    border-top: 3px solid #0f766e;
}

.title {
    font-size: 0.8rem;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: #6c757d;
    margin-bottom: 8px;
}

.value {
    font-size: 1.8rem;
    line-height: 1;
    font-weight: 700;
}

.row>.col {
    flex: 0 0 20%;
    max-width: 20%;
}
</style>