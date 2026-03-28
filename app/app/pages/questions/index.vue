<script setup>
import List from '~/components/questions/List.vue'

definePageMeta({
    layout: 'app',
})
</script>
<template>
    <div>
        <div class="flex justify-between">
            <h2 class="text-2xl md:text-4xl font-bold mb-4">{{ $t('pages.questions.title') }}</h2>
            <NuxtLink
                :to="$localePath('/questions/new')"
                class="waha-button"
            >
                {{ $t('pages.questions.new') }}
            </NuxtLink>
        </div>
        <div class="mt-8">
            <List />
        </div>
    </div>
</template>