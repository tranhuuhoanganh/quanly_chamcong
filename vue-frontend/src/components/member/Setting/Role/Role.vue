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
                                <th class="py-3">Tên vai trò</th>
                                <th class="py-3">Ghi chú</th>
                                <th class="py-3 text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr v-for="(role, index) in roles" :key="role.role_id"
                                :class="{ 'inactive-row': role.status == 0 }">

                                <td class="ps-4">
                                    {{ index + 1 }}
                                </td>

                                <td>
                                    {{ role.role_name }}
                                </td>

                                <td>
                                    {{ role.role_description }}
                                </td>

                                <td class="text-center">

                                    <button class="btn btn-sm btn-light border me-2" style="border-radius:10px;"
                                        @click="openEditModal(role)">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </button>

                                    <button class="btn btn-sm btn-light border text-danger" style="border-radius:10px;"
                                        @click="openDeleteModal(role)">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>
            <BoxPopCreateRole v-if="showCreateRole" @close="showCreateRole = false" @update="getRole"></BoxPopCreateRole>
            <BoxPopDeleteRole v-if="showDeleteRole" :role="selectDeleteRole" @close="showDeleteRole = false" @update="getRole"></BoxPopDeleteRole>
            <BoxPopEditRole v-if="showEditRole" :role="selectEditRole" @close="showEditRole = false" @update="getRole"></BoxPopEditRole>

        </div>
    </template>

<script setup>
import { ref, onMounted } from 'vue';
import api from '../../../../axios';
import BoxPopCreateRole from './BoxPopCreateRole.vue';
import BoxPopDeleteRole from './BoxPopDeleteRole.vue';
import BoxPopEditRole from './BoxPopEditRole.vue';
const roles = ref([])
const showCreateRole = ref(false)
const showDeleteRole = ref(false)
const showEditRole = ref(false)
const getRole = async () => {
    try {
        const res = await api.get(`role`)
        roles.value = res.data
    } catch (error) {
        console.log(error)
    }
}
onMounted(() => {
    getRole()
})

const openCreateModal = () => {
    showCreateRole.value = true
}
const selectEditRole = ref(null)
const openEditModal = (role) => {
    selectEditRole.value = role
    showEditRole.value = true
}

const selectDeleteRole = ref(null)
const openDeleteModal = (role) => {
    selectDeleteRole.value = role.role_id
    showDeleteRole.value = true
}

</script>

<style scoped>
.inactive-row td {
    background: #bbbec1 !important;
}
</style>