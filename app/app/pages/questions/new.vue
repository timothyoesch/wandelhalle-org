<script setup>
import PoliticianMenu from '~/components/form/PoliticianMenu.vue';
import TopicMenu from '~/components/form/TopicMenu.vue';
const client = useSanctumClient()

definePageMeta({
    layout: 'app',
    middleware: ['auth']
})
const form = reactive({
    politician: null,
    question: '',
    rationale: '',
    topics: []
})

function handleSubmit() {
    const payload = {
        politician_id: form.politician ? form.politician.value : null,
        body: form.question,
        rationale: form.rationale,
        topic_ids: form.topics.map(topic => topic.value)
    }

    // validate form data
    if (!payload.politician_id) {
        alert('Please select a politician.')
        return
    } else if (!payload.body.trim()) {
        alert('Please enter a question.')
        return
    } else if (!payload.rationale.trim()) {
        alert('Please enter a rationale.')
        return
    } else if (payload.topic_ids.length === 0) {
        alert('Please select at least one topic.')
        return
    }

    // Submit the form data to the API
    console.log('Submitting question with payload:', payload)
    try {
        client("/api/questions", {
            method: "POST",
            body: payload
        }).then(() => {
            // Clear the saved question from localstorage
            localStorage.removeItem('current_question_body')
            // Redirect to the questions list page after successful submission
            navigateTo('/questions')
        }).catch(error => {
            console.error('Error submitting question:', error)
            alert('An error occurred while submitting your question. Please try again.')
        })
    } catch (error) {
        console.error('Error submitting question:', error)
        alert('An error occurred while submitting your question. Please try again.')
    } finally {
        localStorage.removeItem('current_question_body')
    }
}

// Check if localstorage contains a saved question and load it into the form
onMounted(() => {
    const savedQuestion = localStorage.getItem('current_question_body')
    if (savedQuestion) {
        form.question = savedQuestion
    }
})
</script>

<template>
    <div class="container">
        <h2 class="text-2xl md:text-4xl font-bold mb-4">{{ $t('pages.questions.new.title') }}</h2>
        <form @submit.prevent="handleSubmit" class="waha-form">
            <div class="waha-form__group">
                <label class="waha-form__label">{{ $t('pages.questions.new.politicianLabel') }}</label>
                <PoliticianMenu v-model="form.politician" />
            </div>
            <div class="waha-form__group">
                <label for="question" class="waha-form__label">{{ $t('pages.questions.new.questionLabel') }}</label>
                <textarea
                    id="question"
                    v-model="form.question"
                    class="waha-form__input waha-form__input--textarea"
                    rows="5"
                    :placeholder="$t('pages.questions.new.questionPlaceholder')"
                    >
                </textarea>
            </div>
            <div class="waha-form__group">
                <label for="rationale" class="waha-form__label">{{ $t('pages.questions.new.rationaleLabel') }}</label>
                <textarea
                    id="rationale"
                    v-model="form.rationale"
                    class="waha-form__input waha-form__input--textarea"
                    rows="5"
                    :placeholder="$t('pages.questions.new.rationalePlaceholder')"
                ></textarea>
            </div>
            <div class="waha-form__group">
                <label class="waha-form__label">{{ $t('pages.questions.new.topicsLabel') }}</label>
                <TopicMenu v-model="form.topics" />
            </div>

            <button type="submit" class="w-fit">{{ $t('pages.questions.new.submit') }}</button>
        </form>
    </div>
</template>