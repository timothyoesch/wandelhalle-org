<script setup>
definePageMeta({
    layout: {
        name: 'auth'
    },
    middleware: ['guest'],
})
const credentials = ref({ name: '', email: '', password: '', password_confirmation: '', role: 'politician' })

const client = useSanctumClient()
const { refreshIdentity } = useSanctumAuth()
const localePath = useLocalePath()
const handleRegister = async () => {
    try {
        await client('/register', {
            method: 'POST',
            body: credentials.value
        })
        await refreshIdentity()
        return navigateTo(localePath('/profile'))
    } catch (error) {
        console.error('Registration error:', error)
        // Handle errors as needed, e.g., show a notification
    }
}

</script>
<template>
    <div>
        <h1 class="text-2xl md:text-4xl font-bold mb-2">{{ $t('pages.register-politician.title') }}</h1>
        <p class="mb-2" v-html="$t('pages.register-politician.description')"></p>
        <form class="waha-form" @submit.prevent="handleRegister">
            <div class="waha-form__group">
                <label for="name">Name</label>
                <input
                    id="name"
                    type="text"
                    v-model="credentials.name"
                    required />
            </div>
            <div class="waha-form__group">
                <label for="email">Email</label>
                <input
                    id="email"
                    type="email"
                    v-model="credentials.email"
                    required />
                <p class="waha-form__helper">
                    {{ $t('pages.register-politician.emailHelper') }}
                </p>
            </div>
            <div class="waha-form__group">
                <label for="password">Password</label>
                <input
                    id="password"
                    type="password"
                    v-model="credentials.password"
                    required />
            </div>
            <div class="waha-form__group">
                <label for="password_confirmation">Confirm Password</label>
                <input
                    id="password_confirmation"
                    type="password"
                    v-model="credentials.password_confirmation"
                    required />
            </div>
            <button type="submit" class="waha-button waha-button--primary mt-4">
                {{ $t('pages.register-politician.submit') }}
            </button>
        </form>
        <p class="text-gray-400 text-sm mt-4" v-html="$t('pages.register-politician.note')">
        </p>
    </div>
</template>