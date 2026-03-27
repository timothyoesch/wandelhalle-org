<script setup>
import Card from './Card.vue'

const props = defineProps({
    query: {
        type: String,
        required: false,
        default: '/api/questions',
    },
})

const client = useSanctumClient()
const questions = ref([])
const loading = ref(false)

async function fetchLatestQuestions() {
    loading.value = true
    try {
        const response = await client(props.query, {
            method: 'GET'
        })
        questions.value = response.data
        loading.value = false
    } catch (error) {
        console.error('Error fetching latest questions:', error)
        loading.value = false
    }
}

onMounted(() => {
    fetchLatestQuestions()
})

watch(() => props.query, () => {
    fetchLatestQuestions()
})

</script>
<template>
    <div class="waha-questions__list flex flex-col gap-y-6 md:gap-y-12">
        <Card
            v-for="question in questions"
            :question="question"
            :key="question.id"
        />
    </div>
</template>