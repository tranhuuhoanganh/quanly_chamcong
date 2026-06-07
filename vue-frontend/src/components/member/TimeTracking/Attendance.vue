<template>
    <div>
        <!-- Action -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <button class="btn action-btn rounded-pill px-4 me-3" @click="createCheckin">
                    Check in
                </button>
                <button class="btn action-btn rounded-pill px-4" @click="createCheckout">
                    Check out
                </button>
            </div>
        </div>

        <!-- Summary -->
        <div class="card border-0 shadow-sm mb-5 summary-card">
            <div class="card-body py-3 px-4">
                <div class="row align-items-center justify-content-center text-center">
                    <div class="col-md-4">
                        <div class="summary-label">Ngày</div>
                        <span class="summary-date">
                            {{ new Date(WorkingDays.work_date).toLocaleDateString('vi-VN') }}
                        </span>
                    </div>
                    <div class="col-md-3">
                        <div class="summary-label">Giờ đến</div>
                        <div class="checkin-time">{{ WorkingDays.checkin_time }}</div>
                    </div>
                    <div class="col-md-1">
                        <i class="fa-solid fa-arrow-right-arrow-left summary-icon"></i>
                    </div>
                    <div class="col-md-4">
                        <div class="summary-label">Giờ về</div>
                        <div class="checkout-time">{{ WorkingDays.checkout_time }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="card border-0 shadow-sm overflow-hidden table-card">
            <div class="card-body p-0">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="py-3 ps-4">Ngày</th>
                            <th class="py-3">Giờ check in</th>
                            <th class="py-3">Thời gian đến muộn</th>
                            <th class="py-3">Giờ check out</th>
                            <th class="py-3">Thời gian về sớm</th>
                            <th class="py-3 text-center">Giải trình</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="Attendance in pagination.items" :key="Attendance.time_entry_id">
                            <td>{{ new Date(Attendance.working_day.work_date).toLocaleDateString('vi-VN') }}</td>
                            <td>{{ Attendance.working_day.checkin_time }}</td>
                            <td>{{ Attendance.late_time_text }}</td>
                            <td>{{ Attendance.working_day.checkout_time }}</td>
                            <td>{{ Attendance.quit_early_text }}</td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm rounded-circle shadow-sm" title="Giải trình"
                                    @click="openModal(Attendance)">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center px-4 py-3 border-top">
                <small class="text-muted">
                    Hiển thị {{ pagination.start + 1 }}–{{ pagination.end }} / {{ Attendances.length }} bản ghi
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

        <Expalaination v-if="ShowModal" :Expalaination="SelectExpalaination" @close="ShowModal = false" />
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import api from '../../../axios'
import { useToast } from 'vue-toastification'
import Expalaination from './Expalaination.vue'
import { usePagination } from '../../../usePagination.js'
import '../../../css/Attendance.css'

const toast = useToast()
const ShowModal = ref(false)
const WorkingDays = ref({})
const Attendances = ref([])
const SelectExpalaination = ref(null)

    const { currentPage, totalPages, pagination, changePage, reset } = usePagination(Attendances, 5)

const openModal = (Attendance) => {
    SelectExpalaination.value = Attendance
    ShowModal.value = true
}

const getWorkingDay = async () => {
    const res = await api.get('attendance/get-working')
    WorkingDays.value = res.data
}

const getAttendance = async () => {
    const res = await api.get('attendance/get-attendance')
    Attendances.value = res.data
    reset()
}

const createCheckin = async () => {
    try {
        const res = await api.post('attendance/create-checkin', {
            day_id: WorkingDays.value.day_id,
            checkin_time: WorkingDays.value.checkin_time,
        })
        await getAttendance()
        toast.success(res.data.message)
    } catch (error) {
        toast.error(error.response.data.message)
    }
}

const createCheckout = async () => {
    try {
        const res = await api.post('attendance/create-checkout', {
            day_id: WorkingDays.value.day_id,
            checkout_time: WorkingDays.value.checkout_time,
        })
        await getAttendance()
        toast.success(res.data.message)
    } catch (error) {
        toast.error(error.response.data.message)
    }
}

onMounted(() => {
    getWorkingDay()
    getAttendance()
})
</script>