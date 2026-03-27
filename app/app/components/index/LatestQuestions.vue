<script setup>
import List from '../questions/List.vue'

const activePage = ref("questions")
const query = ref('/api/questions')
</script>

<template>
    <div class="waha-latestQuestions__container mt-8">
        <div class="waha-tabs border-b-2 border-b-primary flex gap-x-2">
            <div
                class="waha-tabs__tab"
                :class="{ 'waha-tabs__tab--active': activePage === 'questions' }"
                v-on:click="activePage = 'questions'; query = '/api/questions'"
            >
                {{ $t('components.latestQuestions.tabs.questions') }}
            </div>
            <div
                class="waha-tabs__tab"
                :class="{ 'waha-tabs__tab--active': activePage === 'answers' } "
                v-on:click="activePage = 'answers'; query = '/api/questions?order_by=answers'"
            >
                {{ $t('components.latestQuestions.tabs.answers') }}
            </div>
        </div>
        <div class="mt-4">
            <List :query="query" />
        </div>
    </div>
</template>