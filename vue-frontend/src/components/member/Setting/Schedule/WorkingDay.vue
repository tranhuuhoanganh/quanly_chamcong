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
                            <th class="py-3">Ngày</th>
                            <th class="py-3">Giờ check in</th>
                            <th class="py-3">Giờ check out</th>
                            <th class="py-3">Loại ngày làm việc</th>
                            <th class="py-3 text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr v-for="(WorkingDay, index) in WorkingDays" :key="WorkingDay.day_id">
                            <td class="ps-4">
                                {{ index + 1 }}
                            </td>

                            <td>
                                {{ new Date(WorkingDay.work_date).toLocaleDateString('vi-VN') }}
                            </td>
                            <td>
                                {{WorkingDay.checkin_time}} 
                            </td>
                            <td>
                                {{WorkingDay.checkout_time}} 
                            </td>
                            <td>
                                {{WorkingDay.type.type_name}} 
                            </td>

                            <td class="text-center">

                                <button class="btn btn-sm btn-light border me-2" style="border-radius:10px;"
                                    @click="openEditModal(WorkingDay)">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button>
                                <button class="btn btn-sm btn-light border text-danger" style="border-radius:10px;"
                                    @click="openDeleteModal(WorkingDay)">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>
        <BoxPopCreateWorkingDay v-if="showCreateSchedule" @close="showCreateSchedule=false" @update="getWorkingDate" > </BoxPopCreateWorkingDay>
        <BoxPopEditWorkingDay v-if="showEditSchedule" :WorkingDay="selectEditWorking" @close="showEditSchedule=false" @update="getWorkingDate" > </BoxPopEditWorkingDay>
        <BoxPopDeleteWorkingDay v-if="showDeleteSchedule" :WorkingDay="selectDeleteWorking" @close="showDeleteSchedule=false" @update="getWorkingDate" > </BoxPopDeleteWorkingDay>


    </div>
</template>


<script setup>
import { ref,onMounted } from 'vue';
import BoxPopCreateWorkingDay from './BoxPopCreateWorkingDay.vue';
import BoxPopEditWorkingDay from './BoxPopEditWorkingDay.vue';
import BoxPopDeleteWorkingDay from './BoxPopDeleteWorkingDay.vue';
import api from '../../../../axios';
const WorkingDays = ref([])
const showCreateSchedule =ref(false)
const showEditSchedule =ref(false)
const showDeleteSchedule = ref(false)
const openCreateModal = () =>{
    showCreateSchedule.value = true
}
const selectEditWorking = ref(null)
const openEditModal = (WorkingDay) =>{
    selectEditWorking.value = WorkingDay
    showEditSchedule.value = true
}
const selectDeleteWorking = ref(null)

const openDeleteModal = (WorkingDay) =>{
    selectDeleteWorking.value = WorkingDay.day_id
    showDeleteSchedule.value = true
}
const getWorkingDate = async() => {
    const res = await api.get('working-day')
    WorkingDays.value = res.data
    console.log(res)    
}
onMounted(
    () => {
        getWorkingDate()
    }
)
</script>

<style scoped>
.inactive-row td {
background: #bbbec1 !important;
}
.status-badge {
    padding: 6px 12px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 600;
    display: inline-block;
    border: 1px solid transparent;
}

/* Đang làm */
.status-badge.active {
    background: #ecfdf5;
    color: #059669;
    border-color: #a7f3d0;
}

/* Nghỉ làm */
.status-badge.inactive {
    background: #fef2f2;
    color: #dc2626;
    border-color: #fecaca;
}
</style>