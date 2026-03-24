<script setup>
definePageMeta({
    layout: 'app',
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
        const redirectPath = route.query.redirect || localePath('/')
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
    <div>
        <form @submit.prevent="handleLogin">
            <div>
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

            <div>
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
    </div>
</template>
