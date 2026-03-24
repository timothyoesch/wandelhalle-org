import { apiFetch } from "./fetch"

export const loginRequest = async (request) => {
    try {
        await apiFetch('/sanctum/csrf-cookie')

        await apiFetch('/login', {
            method: 'POST',
            body: { ...request }
        })

        const userData = await apiFetch('/api/user')

        return userData

    } catch (error) {
        console.error('Login failed. The tango tripped up:', error)
        return false
    }
}

export const logoutRequest = async () => {
    try {
        await apiFetch('/logout', { method: 'POST' })
        return true
    } catch (error) {
        console.error('Logout failed:', error)
        return false
    }
}