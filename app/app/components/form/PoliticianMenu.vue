<script setup>
const client = useSanctumClient()
import { watchDebounced } from '@vueuse/core'
import { Combobox, ComboboxInput, ComboboxOptions, ComboboxOption } from '@headlessui/vue'

const searchTerm = ref('')
const politicians = ref([])
const selectedPolitician = defineModel()
const isSearching = ref(false)

watchDebounced(searchTerm, async (newTerm) =>
    {
        isSearching.value = true
        try {
            let response
            if (newTerm.trim() === '') {
                response = await client('/api/politicians?per_page=10&sort=last_name', {
                    method: 'GET',
                })
            } else {
                response = await client(`/api/politicians?per_page=10&filter[search]=${encodeURIComponent(newTerm)}&sort=last_name`, {
                    method: 'GET',
                })
            }

            politicians.value = response.data.map((politician) => ({
                label: politician.first_name + ' ' + politician.last_name,
                value: politician.id,
                avatar: politician.avatar_url
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
    <Combobox v-model="selectedPolitician">
        <div class="relative">
            <ComboboxInput
                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-accent-500 focus:border-accent-500 focus:outline-none"
                @change="searchTerm = $event.target.value"
                :displayValue="(option) => option ? option.label : ''"
                :placeholder="$t('components.form.politicianMenu.placeholder')"
            />

            <div v-if="isSearching" class="absolute right-3 top-2.5 text-gray-400 text-sm">
                {{ $t('components.form.politicianMenu.searching') }}
            </div>
            <ComboboxOptions class="absolute z-50 w-full mt-1 bg-white border border-gray-200 rounded-md shadow-lg max-h-60 overflow-auto">
                <div v-if="politicians.length === 0 && searchTerm.length >= 3 && !isSearching" class="px-4 py-2 text-gray-500">
                    {{ $t('components.form.politicianMenu.noResults') }}
                </div>
                <ComboboxOption
                    v-for="politician in politicians"
                    :key="politician.value"
                    :value="politician"
                    class="cursor-pointer select-none relative py-2 px-4 hover:bg-gray-100"
                >
                    <div class="flex items-center gap-3">
                        <img :src="politician.avatar" alt="Avatar" class="w-6 h-6 rounded-full">
                        <span>{{ politician.label }}</span>
                    </div>
                </ComboboxOption>
            </ComboboxOptions>
        </div>
    </Combobox>
  </div>
</template>