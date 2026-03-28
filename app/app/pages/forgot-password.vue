<script setup>
const localePath = useLocalePath()

definePageMeta({
    layout: 'auth',
    middleware: ['guest']
})
const client = useSanctumClient()
const body = ref({
    email: '',
    base_url: localePath('/reset-password')
})

const message = ref('')

async function handleForgotPassword() {
    try {
        await client('/forgot-password', {
            method: 'POST',
            body: body.value
        })
        message.value = $t('pages.forgotPassword.successMessage')
    } catch (error) {
        console.error('Forgot password error:', error)
        alert('An error occurred. Please try again later.')
    }
}

</script>
<template>
    <div>
        <h1 class="text-2xl md:text-4xl font-bold mb-2">{{ $t('pages.forgotPassword.title') }}</h1>
        <p class="mb-4">{{ $t('pages.forgotPassword.description') }}</p>
        <form class="waha-form" @submit.prevent="handleForgotPassword" v-if="!message">
            <div class="waha-form__group">
                <label for="email">Email</label>
                <input
                    v-model="body.email"
                    id="email"
                    type="email"
                    required
                />
            </div>
            <button type="submit" class="waha-button waha-button--primary-950">
                {{ $t('pages.forgotPassword.submit') }}
            </button>
        </form>
        <p v-else class="text-accent-500">{{ message }}</p>
    </div>
</template>