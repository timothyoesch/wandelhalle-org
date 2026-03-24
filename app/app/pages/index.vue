<script setup>
definePageMeta({
    layout: 'app'
})

const { user, isAuthenticated, logout } = useSanctumAuth()
const localePath = useLocalePath()

async function handleLogout() {
    await logout()
    return navigateTo(localePath('/login'))
}
</script>

<template>
    <h1>Home</h1>
    <p>Welcome to the Wandelhalle, {{ isAuthenticated ? user.name : 'Guest' }}!</p>
    <button @click="handleLogout" v-if="isAuthenticated">Logout</button>
</template>