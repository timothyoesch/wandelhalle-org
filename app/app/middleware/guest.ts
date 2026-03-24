export default defineNuxtRouteMiddleware((to, from) => {
    const { isAuthenticated } = useSanctumAuth()
    const localePath = useLocalePath()

    if (isAuthenticated.value) {
        return navigateTo(localePath('/'))
    }
})