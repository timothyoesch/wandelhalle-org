<script setup>
const { locale, setLocale } = useI18n()
setLocale(locale.value)
</script>
<template>
  <NuxtLayout>
    <NuxtPage />
  </NuxtLayout>
</template>