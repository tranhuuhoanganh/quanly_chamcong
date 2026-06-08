<template>
    <div>

        <!-- Title -->
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div class="d-flex align-items-center gap-2" style="width: 30%;">
                <input type="date" class="form-control rounded-pill" v-model="formData.date">
                <button class="btn rounded-pill px-4" style="background: #0f766e; color: #f8f9fa; width: 100%;"
                    @click="search_expalaination">
                    Tìm kiếm
                </button>
                <button class="btn rounded-pill px-4" style="background: #0f766e; color: #f8f9fa; width: 100%;"
                    @click="getExpalaination">
                    Đặt lại
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
                            <th class="py-3">Ngày giải trình</th>
                            <th class="py-3">Loại</th>
                            <th class="py-3">Lý do giải trình</th>
                            <th class="py-3">Trạng thái</th>
                            <th class="py-3 text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr v-for="(expalaination, index) in pagination.items" :key="expalaination.explain_id" >

                            <td class="ps-4">
                                {{ index + 1 }}
                            </td>

                            <td>
                                {{ new Date(expalaination.create_date).toLocaleDateString('vi-VN') }}
                            </td>


                            <td>
                                {{ expalaination.type == 1 ? 'Đi muộn' : 'Về sớm' }}
                            </td>

                            <td>
                                {{ expalaination.reason }}
                            </td>

                            <td>
                                {{ expalaination.status == 0 ? 'Chưa duyệt' : 'Đã duyệt' }}
                            </td>

                            <td class="text-center" v-if=" expalaination.status == 0">
                                <button class="btn btn-sm btn-light border me-2" style="border-radius:10px;"
                                    @click="openEditModal(expalaination)">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button>

                                <button class="btn btn-sm btn-light border text-danger" style="border-radius:10px;"
                                    @click="deleteExpalaination(expalaination.explain_id)">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>
            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center px-4 py-3 border-top">
                <small class="text-muted">
                    Hiển thị {{ pagination.start + 1 }}–{{ pagination.end }} / {{ expalainations.length }} bản ghi
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
        <BoxPopEditExpalaination v-if="showEditExpalaination" :expalaination="selectEditExpalaination" @close="showEditExpalaination = false" @update="getExpalaination"/>
    </div>
</template>

<script setup>
import { reactive,ref, onMounted } from 'vue'
import api from '../../../../axios'
import BoxPopEditExpalaination from './BoxPopEditExpalaination.vue'
import { useToast } from 'vue-toastification'
import { usePagination } from '../../../../usePagination'
const formData = reactive({
    date:''
})
const toast = useToast()
const showEditExpalaination = ref(false)
const expalainations = ref([])
const { currentPage, totalPages, pagination, changePage, reset } = usePagination(expalainations, 7)
const search_expalaination = async () => {
    const res = await api.get('expalaination/search-expalaination',{params: formData})
    expalainations.value = res.data
    reset()
}
const getExpalaination = async () => {
    const res = await api.get(`expalaination/get-expalaination`)
    expalainations.value = res.data
    reset()
}
const deleteExpalaination = async(id) => {
    try {
        const res = await api.delete(`expalaination/delete/${id}`)
        getExpalaination()
        toast.success(res.data.message)
    } catch (error) {
        toast.error(error.response.data.message)
    }
}
const selectEditExpalaination = ref(null)
const openEditModal = (expalaination) => {
    selectEditExpalaination.value = expalaination
    showEditExpalaination.value = true
}
onMounted(() => {
    getExpalaination()
}
)
</script>

<style scoped>
.inactive-row td {
    background: #bbbec1 !important;
}
</style>