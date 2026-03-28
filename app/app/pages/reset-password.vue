<script setup>
definePageMeta({
    layout: 'auth'
})
const { refreshIdentity } = useSanctumAuth()
const $route = useRoute()
const localePath = useLocalePath()
const body = reactive({
    password: '',
    password_confirmation: '',
    token: $route.query.token,
    email: $route.query.email
})

const client = useSanctumClient()
async function handleResetPassword() {
    try {
        await client('/reset-password', {
            method: 'POST',
            body
        })
        await refreshIdentity()
        return navigateTo(localePath('/profile'))
    } catch (error) {
        console.error('Reset password error:', error)
        alert('An error occurred. Please try again later.')
    }
}

</script>
<template>
    <div>
        <h1 class="text-2xl md:text-4xl font-bold mb-2">{{ $t('pages.resetPassword.title') }}</h1>
        <form class="waha-form" @submit.prevent="handleResetPassword">
            <div class="waha-form__group">
                <label for="password">{{ $t('pages.resetPassword.newPassword') }}</label>
                <input
                    v-model="body.password"
                    id="password"
                    type="password"
                    required
                />
            </div>
            <div class="waha-form__group">
                <label for="password_confirmation">{{ $t('pages.resetPassword.confirmPassword') }}</label>
                <input
                    v-model="body.password_confirmation"
                    id="password_confirmation"
                    type="password"
                    required
                />
            </div>
            <button type="submit" class="waha-button waha-button--primary-950">
                {{ $t('pages.resetPassword.submit') }}
            </button>
        </form>
    </div>
</template>