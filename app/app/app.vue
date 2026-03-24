<script setup>
const { locale, setLocale } = useI18n()
setLocale("de")
</script>
<template>
  <NuxtLayout>
    <NuxtPage />
  </NuxtLayout>
</template>