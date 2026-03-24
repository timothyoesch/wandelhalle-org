export default defineNuxtRouteMiddleware(async (to, from) => {
    // Check if user is authenticated. If yes, redirect to dashboard. If not, let them see the login page.
    const { user, fetchUser } = useAuth()
    await fetchUser()

    if (process.client && user.value) {
        return navigateTo('/')
    }
});