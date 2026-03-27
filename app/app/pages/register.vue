<script setup>
definePageMeta({
    layout: 'auth',
    middleware: ['guest']
})
const client = useSanctumClient()
const { refreshIdentity } = useSanctumAuth()

const localePath = useLocalePath()

const credentials = ref({ name: '', email: '', password: '', password_confirmation: '' })
const errors = ref({})

const handleRegister = async () => {
    errors.value = {} // Clear previous errors
    const config = useRuntimeConfig()
    try {
        await client('/register', {
            method: 'POST',
            body: credentials.value
        })
        await refreshIdentity()
        return navigateTo(localePath('/'))
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
    <h1 class="text-2xl md:text-4xl font-bold mb-2">{{ $t('pages.register.title') }}</h1>
    <p class="mb-2">
        {{ $t('pages.register.loginPrompt') }}
        <NuxtLink :to="$localePath('/login')" class="text-accent hover:underline">
            {{ $t('pages.register.loginLink') }}
        </NuxtLink>
    </p>

    <form @submit.prevent="handleRegister" class="waha-form">
        <div class="waha-form__group">
            <label for="name">Name</label>
            <input
                id="name"
                v-model="credentials.name"
                type="text"
                required
            />
            <p v-if="errors.name" style="color: red; font-size: 0.8em;">
                {{ errors.name[0] }}
            </p>
        </div>
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

        <div class="waha-form__group">
            <label for="password_confirmation">Confirm Password</label>
            <input
                id="password_confirmation"
                v-model="credentials.password_confirmation"
                type="password"
                required
            />
            <p v-if="errors.password_confirmation" style="color: red; font-size: 0.8em;">
                {{ errors.password_confirmation[0] }}
            </p>
        </div>

        <p v-if="errors.general" style="color: red; font-size: 0.8em;">
            {{ errors.general[0] }}
        </p>
        <button type="submit" >Register</button>
    </form>

    <p class="text-gray-400 text-sm mt-4">
        {{ $t('pages.register.politicianPrompt') }}
        <NuxtLink :to="$localePath('/register-politician')" class="text-accent hover:underline">
            {{ $t('pages.register.politicianLink') }}
        </NuxtLink>
    </p>
</template>