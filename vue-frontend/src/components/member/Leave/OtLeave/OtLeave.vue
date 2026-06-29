<template>
    <div>
        <div class="row g-3">

            <div class="col">
                <div class="card-stat">
                    <div class="title">Phép được cấp</div>
                    <div class="value text-success">12</div>
                </div>
            </div>

            <div class="col">
                <div class="card-stat">
                    <div class="title">Đã sử dụng</div>
                    <div class="value text-success"></div>
                </div>
            </div>

            <div class="col">
                <div class="card-stat">
                    <div class="title">Còn lại</div>
                    <div class="value text-success"></div>
                </div>
            </div>

            <div class="col">
                <div class="card-stat">
                    <div class="title">Không lương</div>
                    <div class="value text-success"></div>
                </div>
            </div>

            <div class="col">
                <div class="card-stat">
                    <div class="title">Chờ duyệt</div>
                    <div class="value text-success"></div>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <div class="card border-0 shadow-sm overflow-hidden"
            style="border-radius:15px;border-top:3px solid #0f766e !important;">

            <div class="card-body p-0">

                <table class="table align-middle mb-0">

                    <thead style="background:#f8f9fa;">
                        <tr>
                            <th class="py-3 ps-4">STT</th>
                            <th class="py-3">Ngày tăng ca</th>
                            <th class="py-3">Giờ bắt đầu</th>
                            <th class="py-3">Giờ kết thúc</th>
                            <th class="py-3">Loại</th>
                            <th class="py-3">Trạng thái</th>
                            <th class="py-3 text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr v-for="(Ot, index) in pagination.items" :key="Ot.ot_id">

                            <td class="ps-4">
                                {{ index + 1 }}
                            </td>

                            <td>
                                {{ new Date(Ot.ot_date).toLocaleDateString('vi-VN') }}
                            </td>
                            <td>
                            <td>{{ Ot.start_time.slice(0, 5) }}</td>
                            </td>
                            <td>
                            <td>{{ Ot.end_time.slice(0, 5) }}</td>
                            </td>

                            <td>
                                {{ Ot.type.type_name }}
                            </td>

                            <td>
                                {{ Ot.status == 0 ? 'Chưa duyệt' : 'Đã duyệt' }}
                            </td>

                            <td class="text-center">
                                <button class="btn btn-sm btn-light border me-2" style="border-radius:10px;"
                                    @click="openModal(Ot)">
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
                    Hiển thị {{ pagination.start + 1 }}–{{ pagination.end }} / {{ Ots.length }} bản ghi
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
        </div>
        <OtLeaveDetail v-if="showDetailOt" :Ot="selectDetailOt" @close="showDetailOt = false"
            @update="getOt" />
    </div>
</template>

<script setup>
import { reactive, ref, onMounted } from 'vue'
import api from '../../../../axios.js'
import { useToast } from 'vue-toastification'
import { usePagination } from '../../../../usePagination.js'
import OtLeaveDetail from './OtLeaveDetail.vue'
const formData = reactive({
    date: ''
})
const toast = useToast()
const showDetailOt = ref(false)
const Ots = ref([])
const { currentPage, totalPages, pagination, changePage, reset } = usePagination(Ots, 5)

const getOt = async () => {
    const res = await api.get(`ot/get-ot-user`)
    Ots.value = res.data
    reset()
}

const selectDetailOt = ref(null)
const openModal = (Ot) => {
    selectDetailOt.value = Ot
    showDetailOt.value = true
}
onMounted(() => {
    getOt()
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