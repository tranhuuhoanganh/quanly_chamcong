<template>
    <div>

        <!-- Title -->
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <button class="btn rounded-pill px-4" style="background: #0f766e; color: #f8f9fa;" @click="openCreateModal">
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
                            <th class="py-3">Mã phòng ban</th>
                            <th class="py-3">Tên phòng ban</th>
                            <th class="py-3">Trưởng phòng</th>
                            <th class="py-3 text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr v-for="(department, index) in departments" :key="department.depart_id"
                            :class="{ 'inactive-row': department.status == 0 }">

                            <td class="ps-4">
                                {{ index + 1 }}
                            </td>

                            <td>
                                {{ department.depart_code }}
                            </td>

                            <td>
                                {{ department.depart_name }}
                            </td>

                            <td>
                                {{ department.manager?.fullname }}
                            </td>

                            <td class="text-center">

                                <button class="btn btn-sm btn-light border me-2" style="border-radius:10px;"
                                    @click="openEditModal(department)">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button>

                                <button class="btn btn-sm btn-light border me-2" style="border-radius:10px;"
                                    @click="UnAction(department)">

                                    <i :class="department.status == 0
                                        ? 'fa-solid fa-check'
                                        : 'fa-solid fa-rotate-left'
                                        "></i>

                                </button>

                                <button class="btn btn-sm btn-light border text-danger" style="border-radius:10px;"
                                    @click="openDeleteModal(department)">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

        <!-- POPUP -->
        <BoxPopCreateDepartment v-if="showCreateModal" @close="showCreateModal = false"
        @update="getDepartments" />
        <BoxPopEditDepartment v-if="showEditModal" :department="selectedDepartment" @close="showEditModal = false"
            @update="getDepartments" />
        <BoxPopDeleteDepartment v-if="showDeleteModal" :department="selectedDepartment" @close="showDeleteModal = false"
            @update="getDepartments" />


    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import api from '../../../../axios'
import BoxPopEditDepartment from './BoxPopEditDepartment.vue'
import BoxPopDeleteDepartment from './BoxPopDeleteDepartment.vue'
import BoxPopCreateDepartment from './BoxPopCreateDepartment.vue'
const departments = ref([])
const showEditModal = ref(false)

const selectedDepartment = ref(null)

const openEditModal = (department) => {

    selectedDepartment.value = department

    showEditModal.value = true
}
const showDeleteModal = ref(false)

const openDeleteModal = (department) => {
    selectedDepartment.value = department.depart_id

    showDeleteModal.value = true
}

const showCreateModal = ref(false)

const openCreateModal = () => {
    showCreateModal.value = true
}
const getDepartments = async () => {
    try {
        const res = await api.get('department')
        departments.value = res.data.department
        console.log(res)
    } catch (error) {
        console.log(error)
    }
}
const UnAction = async (department) => {
    try {
        await api.put(`/department/action-department/${department.depart_id}`)
        department.status =
            department.status == 1 ? 0 : 1
    } catch (error) {
        console.log(error)
    }
}
onMounted(() => {
    getDepartments()
})
</script>

<style scoped>
.inactive-row td {
    background: #bbbec1 !important;
}
</style>