<script setup>
const props = defineProps({
    width : {
        type: String,
        default: '480px'
    }
})
</script>

<template>
    <div class="min-h-screen bg-accent-100 flex items-center justify-center">
        <div class="waha--login__topbar px-4 py-4 top-0 left-0 right-0 absolute">
            <NuxtLink to="/" class="font-light italic text-[0.5rem] md:text-sm flex flex-col items-center w-fit">
                <AppLogo class="w-16 md:w-28" />
                <span>{{$t("app.name")}}</span>
            </NuxtLink>
        </div>
        <div :style="{ maxWidth: width }" class="w-full bg-white my-20 mx-2 p-6 rounded-md shadow-md">
            <slot />
        </div>
    </div>
</template>