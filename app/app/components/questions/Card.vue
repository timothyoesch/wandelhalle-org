<script setup>
import { onMounted } from 'vue'

const props = defineProps({
    question: {
        type: Object,
        required: true
    }
})

const getExcerpt = (text, maxLength = 200) => {
    if (text.length <= maxLength) {
        return text
    }
    return text.substring(0, maxLength) + '...'
}

</script>
<template>
    <div class="waha-question-card bg-white shadow-md rounded-md">
        <div class="waha-question-card__question-container bg-accent-50 p-4 md:p-6">
            <div class="waha-question-card__question-details flex gap-x-4 text-sm italic">
                <span>{{$t("components.questions.card.details.from")}} {{ props.question.user.public_name }}</span>
                <span class="flex items-center gap-1">
                    <Icon name="heroicons:calendar-20-solid" />
                    {{ new Date(props.question.created_at).toLocaleDateString() }}
                </span>
            </div>
            <p class="waha-question-card__question-body text-xl md:text-2xl mt-2">
                {{ props.question.body }}
            </p>
        </div>
        <div class="waha-question-card__answer-container p-4 md:p-6">
            <div class="waha-question-card__answer__politician">
                <div class="flex gap-x-4">
                    <div class="waha-question-card__answer__politician-avatar flex-shrink-0 w-16">
                        <img :src="props.question.politician.avatar_url" alt="Avatar" class="rounded-full w-16 h-16 overflow-hidden">
                    </div>
                    <div class="waha-question-card__answer__politician-details text-sm">
                        <div
                            class="waha-question-card__answer__politician-details"
                        >
                            <p
                                v-if="props.question.answers.length > 0"
                            >
                                {{ $t("components.questions.card.answer.details.answered.0") }} <b>{{ new Date(props.question.answers[0].created_at).toLocaleDateString() }}</b> {{ $t("components.questions.card.answer.details.answered.1") }} <b>{{ props.question.politician.first_name }} {{ props.question.politician.last_name }}</b></p>
                            <div
                                class="flex md:items-center gap-x-1"
                                v-else
                            >
                                <Icon name="heroicons:clock-20-solid" class="mt-1 md:mt-0 flex-shrink-0"/>
                                <p>
                                    {{ $t("components.questions.card.answer.details.not_answered") }}
                                    <b>{{ props.question.politician.first_name }} {{ props.question.politician.last_name }}</b>
                                </p>
                            </div>
                            <div class="mt-2 md:mt-1 flex gap-x-2 items-center">
                                <div
                                    class="w-3 h-3 rounded-full"
                                    :style="'background-color: ' + props.question.politician.party_color"
                                ></div>
                                <span>{{ props.question.politician.party_name }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p
                class="waha-question-card__answer-body mt-4 md:mt-2 text-lg md:text-xl md:pl-20"
                v-if="props.question.answers.length > 0"
            >
                {{ getExcerpt(props.question.answers[0].body) }}
            </p>
        </div>
    </div>
</template>