<script setup>
import { useAuthStore } from '@/stores/auth'

const authStore = useAuthStore()

const form = reactive({
    email: '',
    password: '',
})

const handleLogin = async (form) => {

    try {
        await authStore.login({ email: form.email, password: form.password })
    } catch (error) {
        console.error('Login failed:', error)
    }
}
</script>

<template>
    <div>
        <form @submit.prevent="handleLogin(form)">
            <input v-model="form.email" type="email" placeholder="Email" required>
            <input v-model="form.password" type="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</template>
