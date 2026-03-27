<script setup>
definePageMeta({
    layout: 'auth',
    middleware: ['guest']
})

const { login } = useSanctumAuth()
const localePath = useLocalePath()
const route = useRoute()

const credentials = ref({ email: '', password: '' })
const errors = ref({})

async function handleLogin() {
    errors.value = {} // Clear previous errors
    try {
        await login(credentials.value)
        const redirectPath = route.query.redirect || localePath('/profile')
        return navigateTo(redirectPath)
    } catch (error) {
        if (error.response?.status === 422) {
            console.log(error.response._data) // Log the full response for debugging
            // Nuxt's fetch stores the JSON payload in _data
            // Laravel structures it as { message: "...", errors: { email: ["..."], password: ["..."] } }
            errors.value = error.response._data?.errors || {}
        } else {
            errors.value = { general: ['An unexpected error occurred. Please try again.'] }
        }
    }
}
</script>

<template>
    <h1 class="text-2xl md:text-4xl font-bold mb-2">{{ $t('pages.login.title') }}</h1>
    <p>
        {{ $t('pages.login.registerPrompt') }}
        <NuxtLink :to="$localePath('/register')" class="text-accent hover:underline">
            {{ $t('pages.login.registerLink') }}
        </NuxtLink>
    </p>
    <p class="mb-2">
        <NuxtLink :to="$localePath('/forgot-password')" class="text-accent hover:underline">
            {{ $t('pages.login.forgotPassword') }}
        </NuxtLink>
    </p>

    <form @submit.prevent="handleLogin" class="waha-form">
        <div class="waha-form__group">
            <label for="email">Email</label>
            <input
                id="email"
                v-model="credentials.email"
                type="email"
                required
            />
            <p v-if="errors.email" style="color: red; font-size: 0.8em;">
                {{ errors.email[0] }}
            </p>
        </div>

        <div class="waha-form__group">
            <label for="password">Password</label>
            <input
                id="password"
                v-model="credentials.password"
                type="password"
                required
            />
            <p v-if="errors.password" style="color: red; font-size: 0.8em;">
                {{ errors.password[0] }}
            </p>
        </div>

        <p v-if="errors.general" style="color: red; font-size: 0.8em;">
            {{ errors.general[0] }}
        </p>
        <button type="submit">Log In</button>
    </form>
    <p class="text-gray-400 text-sm mt-4">
        {{ $t('pages.login.politicianPrompt') }}
        <NuxtLink :to="$localePath('/register-politician')" class="text-accent hover:underline">
            {{ $t('pages.login.politicianLink') }}
        </NuxtLink>
    </p>
</template>
