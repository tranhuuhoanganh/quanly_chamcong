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
                                <th class="py-3">Tên Chức vụ</th>
                                <th class="py-3">Level</th>
                                <th class="py-3">Ghi chú</th>
                                <th class="py-3 text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr v-for="(position, index) in positions" :key="position.pos_id"
                                :class="{ 'inactive-row': position.status == 0 }">

                                <td class="ps-4">
                                    {{ index + 1 }}
                                </td>

                                <td>
                                    {{ position.pos_name }}
                                </td>
                                <td>
                                    {{ position.level }}
                                </td>
                                <td>
                                    {{ position.pos_description }}
                                </td>

                                <td class="text-center">

                                    <button class="btn btn-sm btn-light border me-2" style="border-radius:10px;"
                                        @click="openEditModal(position)">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </button>

                                    <button class="btn btn-sm btn-light border text-danger" style="border-radius:10px;"
                                        @click="openDeleteModal(position)">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>
           <BoxPopCreatePosition v-if="showCreatePos" @close="showCreatePos=false" @update="getPos"></BoxPopCreatePosition>
           <BoxPopDeletePosition v-if="showDeletePos" :position="selectDeletePos" @close="showDeletePos=false" @update="getPos"></BoxPopDeletePosition>
           <BoxPopEditPosition v-if="showEditPos" :position="selectEditPos" @close="showEditPos=false" @update="getPos"></BoxPopEditPosition>

        </div>
    </template>

<script setup>
import { ref,onMounted } from 'vue';
import BoxPopCreatePosition from './BoxPopCreatePosition.vue';
import BoxPopDeletePosition from './BoxPopDeletePosition.vue';
import BoxPopEditPosition from  './BoxPopEditPosition.vue';
import api from '../../../../axios';
const showCreatePos = ref(false)
const showDeletePos = ref(false)
const showEditPos = ref(false)
const positions = ref([])
const openCreateModal = () => {
    showCreatePos.value = true
}
const selectDeletePos = ref(null)
const openDeleteModal = (position) => {
    selectDeletePos.value = position.pos_id
    showDeletePos.value = true
}
const selectEditPos = ref(null)
const openEditModal = (position) => {
    selectEditPos.value = position
    showEditPos.value = true
}
const getPos = async () =>{
    try {
        const res = await api.get(`position`)
        positions.value = res.data
    } catch (error) {
        console.log(error)
    }
}
onMounted(()=>{
    getPos()
})
</script>

<style scoped>
.inactive-row td {
    background: #bbbec1 !important;
}
</style>