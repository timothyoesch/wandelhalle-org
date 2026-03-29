<script setup>
const client = useSanctumClient()
import { watchDebounced } from '@vueuse/core'
import { Combobox, ComboboxInput, ComboboxOptions, ComboboxOption } from '@headlessui/vue'
const { locale } = useI18n()
const searchTerm = ref('')
const topics = ref([])
const selectedTopics = defineModel({ type: Array, default: () => [] })
const isSearching = ref(false)

function removeTopic(topicToRemove) {
    selectedTopics.value = selectedTopics.value.filter(
        (t) => t.value !== topicToRemove.value
    )
}

watchDebounced(searchTerm, async (newTerm) =>
    {
        isSearching.value = true
        try {
            let response
            if (newTerm.trim() === '') {
                response = await client('/api/topics?per_page=20&sort=name', {
                    method: 'GET',
                    headers: {
                        'Accept-Language': locale.value
                    }
                })
            } else {
                response = await client(`/api/topics?per_page=20&filter[name]=${encodeURIComponent(newTerm)}&sort=name`, {
                    method: 'GET',
                    // Add the Accept-Language header to ensure the API returns localized topic names
                    headers: {
                        'Accept-Language': locale.value
                    }
                })
            }

            topics.value = response.data.map((topic) => ({
                label: topic.name,
                value: topic.id
            }))
        } catch (error) {
            console.error('Search failed:', error)
        } finally {
            isSearching.value = false
        }
    }, {
        debounce: 500, // wait for 500ms of inactivity
    }
)
</script>

<template>
  <div>
    <div class="waha-form__topic-menu__selected-items mb-2 flex flex-wrap gap-2">
        <span
            v-for="topic in selectedTopics"
            :key="topic.value"
            class="inline-flex items-center gap-1 bg-accent-100 text-accent-800 text-sm p-2 rounded-md leading-0"
        >
            {{ topic.label }}
            <button
                type="button"
                @click.stop="removeTopic(topic)"
                class="text-accent-600 hover:text-accent-900 focus:outline-none"
            >
                <Icon name="heroicons:x-mark" class="w-4 h-4" />
            </button>
        </span>
    </div>
    <Combobox v-model="selectedTopics" multiple by="value">
        <div class="relative">
            <ComboboxInput
                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-accent-500 focus:border-accent-500 focus:outline-none"
                @change="searchTerm = $event.target.value"
                :displayValue="(option) => option ? option.label : ''"
                :placeholder="$t('components.form.topicMenu.placeholder')"
            />

            <div v-if="isSearching" class="absolute right-3 top-2.5 text-gray-400 text-sm">
                {{ $t('components.form.topicMenu.searching') }}
            </div>

            <ComboboxOptions class="absolute z-50 w-full mt-2 left-0 bg-white border border-gray-200 rounded-md shadow-lg max-h-60 overflow-auto">
                <div v-if="topics.length === 0 && searchTerm.length >= 3 && !isSearching" class="px-4 py-2 text-gray-500">
                    {{ $t('components.form.topicMenu.noResults') }}
                </div>
                <ComboboxOption
                    v-for="topic in topics"
                    :key="topic.value"
                    :value="topic"
                    class="cursor-pointer select-none relative py-2 px-4 hover:bg-gray-100"
                    v-slot="{ selected }"
                >
                    <div class="flex items-center gap-3">
                        <span :class="{ 'font-bold text-accent-600': selected }">
                            {{ topic.label }}
                        </span>
                        <span v-if="selected" class="text-accent-600 ml-auto">✓</span>
                    </div>
                </ComboboxOption>
            </ComboboxOptions>
        </div>
    </Combobox>
  </div>
</template>