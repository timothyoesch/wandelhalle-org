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
            allowedHosts: ['app.wandelhalle.lndo.site'],
        },
    },

    runtimeConfig: {
        public: {
            apiUrl: '',
        }
    },

    modules: ['@nuxtjs/tailwindcss', '@nuxt/fonts', '@nuxtjs/i18n', '@pinia/nuxt'],
    tailwindcss: {
        exposeConfig: true,
        viewer: true,
    },
    fonts: {
        families: [
            {
                name: 'Inter',
                provider: "npm"
            }
        ]
    },
    i18n: {
        locales: [
            { code: 'de', name: 'Deutsch', file: 'de.json' },
            { code: 'fr', name: 'Français', file: 'fr.json' },
            { code: 'it', name: 'Italiano', file: 'it.json' }
        ],
        defaultLocale: 'de',
        strategy: 'prefix',
    }
})