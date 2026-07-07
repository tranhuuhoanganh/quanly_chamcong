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
                            <th class="py-3">Phòng ban</th>
                            <th class="py-3">Chức vụ</th>
                            <th class="py-3">Vai trò</th>
                            <th class="py-3">Liên hệ</th>
                            <th class="py-3">Trạng thái</th>
                            <th class="py-3 text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr v-for="(employee, index) in employees" :key="employee.id"
                            :class="{ 'inactive-row': employee.status == 0 }">

                            <td class="ps-4">
                                {{ index + 1 }}
                            </td>

                            <td>
                                {{employee.emp_code}} - {{ employee.fullname }}
                            </td>
                            <td>
                                {{employee.department.depart_name}} 
                            </td>
                            <td>
                                {{employee.position.pos_name}} 
                            </td>
                            <td>
                                {{employee.role.role_name}} 
                            </td>
                            <td>
                                {{employee.phone}} 
                            </td>
                            <td>
                                <span
                                    class="status-badge"
                                    :class="employee.status == 1 ? 'active' : 'inactive'">
                                    {{ employee.status == 1 ? 'Đang làm' : 'Nghỉ làm' }}
                                </span>
                            </td>

                            <td class="text-center">

                                <button class="btn btn-sm btn-light border me-2" style="border-radius:10px;"
                                    @click="openEditModal(employee)">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button>
                                <button class="btn btn-sm btn-light border me-2" style="border-radius:10px;"
                                    @click="UnAction(employee)">

                                    <i :class="employee.status == 0
                                        ? 'fa-solid fa-check'
                                        : 'fa-solid fa-rotate-left'
                                        "></i>

                                </button>
                                <button class="btn btn-sm btn-light border text-danger" style="border-radius:10px;"
                                    @click="openDeleteModal(employee)">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>
       <BoxPopCreateEmployee v-if="showCreateEmployee" @close="showCreateEmployee=false" @update="getEmployee"> </BoxPopCreateEmployee>
       <BoxPopDeleteEmployee v-if="showDeleteEmployee" :employee="selectDeleteEmployee" @close="showDeleteEmployee=false" @update="getEmployee"> </BoxPopDeleteEmployee>
       <BoxPopEditEmployee v-if="showEditEmployee" :employee="selectEditEmployee" @close="showEditEmployee=false" @update="getEmployee"> </BoxPopEditEmployee>

    </div>
</template>

<script setup>
import { ref,onMounted } from 'vue';
import api from '../../../../axios';
import BoxPopCreateEmployee from './BoxPopCreateEmployee.vue';
import BoxPopDeleteEmployee from './BoxPopDeleteEmployee.vue';
import BoxPopEditEmployee from './BoxPopEditEmployee.vue';
const showCreateEmployee = ref(false)
const showDeleteEmployee = ref(false)
const showEditEmployee = ref(false)

const employees = ref([])
const openCreateModal = () =>{
    showCreateEmployee.value = true
}
const getEmployee = async() =>{
    const res = await api.get(`employee`)
    employees.value = res.data
    console.log(res);
}
onMounted(
    ()=>{
        getEmployee()
    }
)
const UnAction = async(employee) =>{
    await api.put(`employee/action-employee/${employee.id}`)
    employee.status =
    employee.status == 1 ? 0 : 1
}

const selectEditEmployee = ref(null)
const openEditModal = (employee) => {
    selectEditEmployee.value = employee
    showEditEmployee.value = true
}

const selectDeleteEmployee = ref(null)
const openDeleteModal = (employee) => {
    selectDeleteEmployee.value = employee.id
    showDeleteEmployee.value = true
}
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