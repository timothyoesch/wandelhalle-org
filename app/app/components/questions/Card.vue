<script setup>
import ThumbIcon from './ThumbIcon.vue'
const client = useSanctumClient()
const { isAuthenticated } = useSanctumAuth()
const localePath = useLocalePath()

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

const voteStatus = ref(props.question.upvoted ? 'like' : props.question.downvoted ? 'dislike' : null)
const upvotesCount = ref(props.question.upvotes_count)
const downvotesCount = ref(props.question.downvotes_count)

const handleVote = (type) => {
    if (!isAuthenticated.value) {
        return navigateTo(localePath('/login'))
    }
    if (voteStatus.value === 'like') {
        upvotesCount.value -= 1
    } else if (voteStatus.value === 'dislike') {
        downvotesCount.value -= 1
    }
    if (voteStatus.value === type) {
        voteStatus.value = null
    } else {
        voteStatus.value = type
    }
    if (voteStatus.value === 'like') {
        upvotesCount.value += 1
    } else if (voteStatus.value === 'dislike') {
        downvotesCount.value += 1
    }
    try {
        client("/api/questions/" + props.question.id + "/vote", {
            method: "POST",
            body: {
                type: voteStatus.value
            }
        })
    } catch (error) {
        console.error("Error voting:", error)
    }
}

</script>
<template>
    <div class="waha-question-card bg-white shadow-md rounded-md overflow-hidden">
        <div class="waha-question-card__question-container bg-accent-50 p-4 md:p-6">
            <div class="waha-question-card__question-details flex gap-x-4 text-sm italic">
                <span>{{$t("components.questions.card.details.from")}} {{ props.question.user.public_name }}</span>
                <span class="flex items-center gap-1">
                    <Icon name="heroicons:calendar-20-solid" />
                    {{ new Date(props.question.created_at).toLocaleDateString("de-CH") }}
                </span>
            </div>
            <p class="waha-question-card__question-body text-xl md:text-2xl mt-2">
                {{ props.question.body }}
            </p>
        </div>
        <div class="waha-question-card__answer-container p-4 md:p-6">
            <div class="waha-question-card__answer__politician">
                <div class="flex gap-x-4">
                    <div class="waha-question-card__answer__politician-avatar flex-shrink-0 w-12">
                        <img :src="props.question.politician.avatar_url" alt="Avatar" class="rounded-full w-12 h-12 overflow-hidden">
                    </div>
                    <div class="waha-question-card__answer__politician-details text-sm">
                        <div
                            class="waha-question-card__answer__politician-details"
                        >
                            <p
                                v-if="props.question.answers.length > 0"
                            >
                                {{ $t("components.questions.card.answer.details.answered.0") }} <b>{{ new Date(props.question.answers[0].created_at).toLocaleDateString("de-CH") }}</b> {{ $t("components.questions.card.answer.details.answered.1") }} <b>{{ props.question.politician.first_name }} {{ props.question.politician.last_name }}</b></p>
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
                                <span>{{ props.question.politician.party_abbreviation }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p
                class="waha-question-card__answer-body mt-4 md:mt-2 text-lg md:text-xl md:pl-16"
                v-if="props.question.answers.length > 0"
            >
                {{ getExcerpt(props.question.answers[0].body) }}
            </p>
        </div>
        <div class="waha-question-card__actions-container p-4 md:p-6 bg-gray-200">
            <div class="waha-question-card__actions flex gap-x-4">
                <ThumbIcon
                    :type="'like'"
                    :count="upvotesCount"
                    :active="voteStatus === 'like'"
                    v-on:click="handleVote('like')"
                />
                <ThumbIcon
                    :type="'dislike'"
                    :count="downvotesCount"
                    :active="voteStatus === 'dislike'"
                    v-on:click="handleVote('dislike')"
                />
            </div>
        </div>
    </div>
</template>