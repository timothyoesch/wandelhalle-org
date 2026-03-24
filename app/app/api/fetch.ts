export const apiFetch = $fetch.create({
    baseURL: "https://api.wandelhalle.lndo.site",
    headers: {
        Accept: 'application/json',
    },
    credentials: 'include',

    onRequest({ options }) {
        // Grab the cookie that Laravel set during the pre-flight check
        const xsrfToken = useCookie('XSRF-TOKEN').value

        if (xsrfToken) {
            // Attach it to the headers exactly how Laravel expects it
            options.headers = {
                ...options.headers,
                "Accept": 'application/json',
                'X-XSRF-TOKEN': xsrfToken
            }
        }
    }
})