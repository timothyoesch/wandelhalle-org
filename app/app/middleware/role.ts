export default defineNuxtRouteMiddleware(async (to, from) => {
    const { user, fetchUser } = useAuth()
    await fetchUser()

    const requiredRole = to.meta.role
    if (requiredRole && (!user.value || !user.value.roles.includes(requiredRole))) {
        // Return a 403 Forbidden response or redirect to an error page
        if (process.client) {
            console.warn(`Access denied. User does not have the required role: ${requiredRole}`)
            throw createError({ statusCode: 401, statusText: 'Unauthorized', message: 'Forbidden: You do not have the required permissions to access this page.' })
        }
    }
})