import { loginRequest, logoutRequest } from '@/api/auth'

export const useAuthStore = defineStore("auth", {
    state: () => ({
        user: fetchUserData()?.user || null,
        roles: fetchUserData()?.roles || []
    }),
    actions: {
        async login(request) {
            try {
                const userData = await loginRequest(request)
                if (userData) {
                    this.user = userData.user || null
                    this.roles = userData.roles || []
                    return true
                }
                return false
            } catch (error) {
                console.error('Login failed:', error)
                return false
            }
        },
        async logout() {
            try {
                const success = await logoutRequest()
                if (success) {
                    this.user = null
                    this.roles = []
                }
                return success
            } catch (error) {
                console.error('Logout failed:', error)
                return false
            }
        }
    }
})

function fetchUserData() {
    try {
        const data = localStorage.getItem('userData')
        return data ? JSON.parse(data) : null
    } catch (error) {
        console.error('Failed to fetch user data from localStorage:', error)
        return null
    }
}