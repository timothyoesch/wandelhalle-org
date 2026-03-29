<script setup>
import { ref, computed } from 'vue'
import Card from './Card.vue'
const route = useRoute()

const props = defineProps({
    query: {
        type: String,
        required: false,
        default: '/api/questions?include=politician,answers,topics,user&page=1&sort=-created_at',
    },
})

const client = useSanctumClient()
const currentPage = ref(1)

// 2. useAsyncData handles the SSR, caching, and loading state automatically
const { data: response, pending, error } = await useAsyncData(
    `questions-list-${route.fullPath}-${currentPage.value}`,
    () => {
        const separator = props.query.includes('?') ? '&' : '?'
        const fetchUrl = `${props.query}${separator}page=${currentPage.value}`

        return client(fetchUrl, { method: 'GET' })
    },
    {
        // THE MAGIC: Nuxt will automatically re-run the fetch function
        // whenever currentPage or props.query changes!
        watch: [currentPage, () => props.query]
    }
)

// 3. Instead of manually reassigning variables, we just compute them from the response
const questions = computed(() => response.value?.data || [])

const pagination = computed(() => ({
    totalPages: response.value?.meta?.last_page || 1,
    perPage: response.value?.meta?.per_page || 10,
    totalItems: response.value?.meta?.total || 0,
}))

watch(() => props.query, () => {
    currentPage.value = 1
})

const questionsListDOM = ref(null)

watch([currentPage, () => props.query], () => {
    // Scroll to top of the questions list when page or query changes
    if (questionsListDOM.value && import.meta.client) {
        questionsListDOM.value.scrollIntoView({
            behavior: 'smooth',
        })
    }
})
</script>

<template>
    <div class="waha-questions__list__container">
        <div v-if="error" class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <p class="font-bold">SSR Fetch Failed:</p>
            <pre class="text-xs">{{ error }}</pre>
        </div>
        <div class="waha-questions__list flex flex-col gap-y-6 md:gap-y-12" ref="questionsListDOM">
            <Card
                v-for="question in questions"
                :question="question"
                :key="question.id"
            />
        </div>
        <div class="waha-questions__list__pagination flex justify-end mt-12" v-if="pagination.totalItems > 0">
            <UPagination
                v-model:page="currentPage"
                :page-count="pagination.perPage"
                :total="pagination.totalItems"
            />
        </div>
    </div>
</template>