// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
    compatibilityDate: '2025-07-15',
    devtools: { enabled: true },

    vite: {
        server: {
            hmr: {
                protocol: 'wss',
                host: 'app.wandelhalle.lndo.site',
                port: 443
            },
            allowedHosts: [
                process.env.NUXT_PUBLIC_ALLOWED_HOSTS || 'app.wandelhalle.lndo.site'
            ],
        },
    },

    runtimeConfig: {
        public: {
            apiUrl: '',
        }
    },

    modules: [
        "@nuxt/fonts",
        '@nuxtjs/i18n',
        '@pinia/nuxt',
        'nuxt-auth-sanctum',
        '@nuxt/icon',
        '@nuxt/ui',
    ],
    fonts: {
        families: [
            {
                name: 'Inter',
                provider: 'google',
                // You can explicitly list weights here if you want to be safe,
                // but it usually auto-detects them based on your Tailwind usage!
                weights: [400, 500, 600, 700, 900],
            }
        ]
    },
    css: [
        '~/assets/css/main.css',
        '~/assets/css/app.css',
    ],
    i18n: {
        locales: [
            { code: 'de', name: 'Deutsch', file: 'de.json' },
            { code: 'fr', name: 'Français', file: 'fr.json' },
            { code: 'it', name: 'Italiano', file: 'it.json' }
        ],
        defaultLocale: 'de',
        strategy: 'prefix',
        compilation: {
            strictMessage: false
        }
    },
    sanctum: {
        baseUrl: process.env.NUXT_PUBLIC_API_URL || 'https://api.wandelhalle.lndo.site',
        mode: 'cookie',


        redirect: {
            keepRequestedRoute: false,
            onAuthOnly: false,
            onGuestOnly: false,
            onLogin: false,
            onLogout: false
        },

        // Match these strictly to your Laravel api.php and web.php routes
        endpoints: {
            csrf: '/sanctum/csrf-cookie',
            login: '/login',
            logout: '/logout', // Ensure this is a POST route in Laravel
            user: '/api/user',
        }
    }
})