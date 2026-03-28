<script setup>
import LatestQuestions from '~/components/index/LatestQuestions.vue'


definePageMeta({
    layout: 'app'
})

const localePath = useLocalePath()

const form = reactive({
    body: ''
})

const textarea = ref(null)
const errors = ref({})

onMounted(() => {
    textarea.value.addEventListener("input", function() {
        this.style.height = "auto";
        this.style.height = this.scrollHeight + "px";
    });
})

async function handleSubmit() {
    if (form.body.length === 0 || form.body.length > 200) {
        errors.value.body = [form.body.length === 0 ? 'empty' : 'too_long']
        return
    }

    localStorage.setItem('current_question_body', form.body)
    alert("Question submission folgt!")
}

</script>

<template>
    <div class="waha-container__inner">
        <div class="waha-index__heroine text-center">
            <h2 class="text-xl md:text-2xl">{{ $t('pages.index.title.line1') }}</h2>
            <h1 class="text-4xl md:text-[7vw] underline md:leading-[1] font-black text-accent-500 italic">{{ $t('pages.index.title.line2') }}</h1>
        </div>
        <div class="waha-index__cta mt-8">
            <form @submit.prevent="handleSubmit" class="waha-form">
                <div class="waha-form__group">
                    <textarea v-model="form.body" ref="textarea" :placeholder="$t('pages.index.cta.placeholder')" class="min-h-40"></textarea>
                    <p v-if="errors.body?.length" class="text-red-500 text-sm mt-1">{{ $t('pages.index.cta.error.' + errors.body[0]) }}</p>
                </div>
                <div class="flex justify-between">
                    <span
                        class="text-sm text-gray-500"
                        :class="form.body.length > 200 ? 'text-red-500' : ''"
                    >
                        {{ form.body.length }} / 200
                    </span>
                    <button type="submit" class="w-fit mt-4">{{ $t('pages.index.cta.submit') }}</button>
                </div>
            </form>
        </div>
        <div class="waha-index__latest-questions mt-12">
            <h2 class="text-2xl md:text-4xl font-bold mb-4">{{ $t('pages.index.latestQuestions.title') }}</h2>
            <LatestQuestions />
        </div>
    </div>
</template>