export default defineNuxtRouteMiddleware((to, from) => {
    const { isAuthenticated } = useSanctumAuth()
    const localePath = useLocalePath()

    if (!isAuthenticated.value) {
        return navigateTo({
            path: localePath('/login'),
            query: { redirect: to.fullPath }
        })
    }
})