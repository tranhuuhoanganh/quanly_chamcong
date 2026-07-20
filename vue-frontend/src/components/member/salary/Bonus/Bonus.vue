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

                            <tr v-for="(bonus, index) in Bonuses" :key="bonus.bonus_id">

                                <td class="ps-4">
                                    {{ index + 1 }}
                                </td>

                                <td>
                                    {{ bonus.user.name }}
                                </td>

                                <td>
                                    {{ bonus.bonus_type.name }}
                                </td>

                                <td>
                                    {{ Number(bonus.amount).toLocaleString('en-US') }}                                
                                </td>

                                <td>
                                    {{ bonus.payroll_month.split('-').reverse().join('/') }}                                
                                </td>

                                <td class="text-center">

                                    <button class="btn btn-sm btn-light border me-2" style="border-radius:10px;"
                                        @click="openEditModal(bonus)">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </button>

                                    <button class="btn btn-sm btn-light border text-danger" style="border-radius:10px;"
                                        @click="openDeleteModal(bonus)">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>
           <BoxPopCreateBonus v-if="showCreateBonus" @close="showCreateBonus = false" @update="getBonus" />
           <BoxPopEditBonus v-if="showEditBonus" :bonus="selectedEditBonus" @close="showEditBonus = false" @update="getBonus" />
           <BoxPopDeleteBonus v-if="showDeleteBonus" :bonus="selectedDeleteBonus" @close="showDeleteBonus = false" @update="getBonus" />
        </div>
    </template>

<script setup>
import { ref, onMounted } from 'vue';
import api from '../../../../axios.js';
import BoxPopCreateBonus from './BoxPopCreateBonus.vue';
import BoxPopEditBonus from './BoxPopEditBonus.vue';
import BoxPopDeleteBonus from './BoxPopDeleteBonus.vue';
const Bonuses = ref([])
const showEditBonus = ref(false)
const showCreateBonus = ref(false)
const showDeleteBonus = ref(false)
const getBonus = async () => {
        const res = await api.get(`bonus/get-bonus`)
        Bonuses.value = res.data
}
onMounted(() => {
    getBonus()
})
const openCreateModal = () => {
    showCreateBonus.value = true
}
const selectedEditBonus = ref(null)
const openEditModal = (bonus) => {
    selectedEditBonus.value = bonus
    showEditBonus.value = true
}
const selectedDeleteBonus = ref(null)
const openDeleteModal = (bonus) => {
    selectedDeleteBonus.value = bonus.bonus_id
    showDeleteBonus.value = true
}
</script>

<style scoped>
.inactive-row td {
    background: #bbbec1 !important;
}
</style>