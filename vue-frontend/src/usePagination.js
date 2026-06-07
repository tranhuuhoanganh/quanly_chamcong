import { ref, computed, isRef } from 'vue'

export function usePagination(data, perPage = 5) {
    const currentPage = ref(1)
    const _perPage = isRef(perPage) ? perPage : ref(perPage)

    const totalPages = computed(() => Math.ceil(data.value.length / _perPage.value))

    const pagination = computed(() => {
        const start = (currentPage.value - 1) * _perPage.value
        const end = Math.min(start + _perPage.value, data.value.length)
        return { items: data.value.slice(start, end), start, end }
    })

    const changePage = (page) => {
        if (page >= 1 && page <= totalPages.value) currentPage.value = page
    }

    const reset = () => { currentPage.value = 1 }

    return { currentPage, totalPages, pagination, changePage, reset, perPage: _perPage }
}