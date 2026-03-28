<script setup>
const props = defineProps({
    type: {
        type: String,
        required: true
    },
    count: {
        type: Number,
        required: true
    },
    active: {
        type: Boolean,
        required: true
    },
})

const icon = ref(props.type === 'like' ? 'heroicons:hand-thumb-up-20-solid' : 'heroicons:hand-thumb-down-20-solid');

</script>
<template>
    <div class="flex items-center gap-x-2 cursor-pointer">
        <Icon
            :name="icon"
            class="text-xl"
            :class="{
                'text-accent-500': active,
            }"
        />
        <span
            :class="{
                'text-accent-500': active,
            }"
        >{{ count }}</span>
    </div>
</template>