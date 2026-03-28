<script setup>
const { locale, setLocale } = useI18n()
setLocale(locale.value)

onMounted(() => {
    const vh = window.innerHeight * 0.01
    document.documentElement.style.setProperty('--vh', `${vh}px`)

    window.addEventListener('resize', () => {
        const vh = window.innerHeight * 0.01
        document.documentElement.style.setProperty('--vh', `${vh}px`)
    })
})
</script>
<template>
    <UApp>
        <NuxtLayout>
            <NuxtPage />
        </NuxtLayout>
    </UApp>
</template>