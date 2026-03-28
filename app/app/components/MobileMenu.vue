<script setup>
const {user, isAuthenticated, logout} = useSanctumAuth()
const localePath = useLocalePath()
const config = useRuntimeConfig()
const adminUrl = config.public.apiUrl + '/admin'
async function handleLogout() {
    await logout()
    return navigateTo(localePath('/login'))
}

const props = defineProps({
    menuOpen: {
        type: Boolean,
        default: false
    }
})

const menuDom = ref(null)

watch(() => props.menuOpen, (newVal) => {
    if (newVal) {
        // Make window scroll to top when opening the menu and set overflow hidden to prevent scrolling the background
        window.scrollTo({ top: 0, behavior: 'smooth' })
        document.body.style.overflow = 'hidden'
        menuDom.value.animate([
            { maxHeight: '0px' },
            { maxHeight: '100vh' }
        ], {
            duration: 300,
            easing: 'ease-in-out',
            fill: 'forwards'
        })
    } else {
        document.body.style.overflow = 'auto'
        menuDom.value.animate([
            { maxHeight: '100vh' },
            { maxHeight: '0px' }
        ], {
            duration: 300,
            easing: 'ease-in-out',
            fill: 'forwards'
        })
    }
})

</script>
<template>
    <div class="waha-navbar__mobile-menu max-h-0 overflow-hidden w-full fixed top-0 left-0 z-10 bg-accent-100" ref="menuDom">
        <div class="waha-navbar__mobile-menu--container max-w-[85rem] mx-auto px-4 md:px-8 py-4 pt-32 min-h-screen">
            <div class="waha-navbar__mobile-menu--inner flex flex-col gap-6">
                <div class="waha-navbar__links__lower flex flex-col font-bold gap-2 text-3xl">
                    <NuxtLink
                        :to="$localePath('/questions')"
                        :class="{
                            'text-accent-500': $route.path.indexOf($localePath('/questions')) != -1,
                        }"
                    >
                        {{ $t('links.questions') }}
                    </NuxtLink>
                    <NuxtLink
                        :to="$localePath('/topics')"
                        :class="{
                            'text-accent-500': $route.path.indexOf($localePath('/topics')) != -1,
                        }"
                    >
                        {{ $t('links.topics') }}
                    </NuxtLink>
                </div>
                <div class="waha-navbar__links__upper flex flex-col text-xs gap-2">
                    <NuxtLink
                        :to="$localePath('/register')"
                        v-if="!isAuthenticated"
                    >
                        {{ $t('links.register') }}
                    </NuxtLink>
                    <NuxtLink
                        :to="$localePath('/login')"
                        v-if="!isAuthenticated"
                    >
                        {{ $t('links.login') }}
                    </NuxtLink>
                    <NuxtLink
                        :to="$localePath('/profile')"
                        class="flex items-center gap-x-1"
                        v-if="isAuthenticated"
                    >
                        {{ user.name }}
                        <Icon class="text-xl" name="heroicons:user-circle-20-solid" />
                    </NuxtLink>
                    <NuxtLink
                        :to="adminUrl"
                        class="flex items-center gap-x-1"
                        v-if="isAuthenticated && user.roles.includes('super_admin')"
                    >
                        {{ $t('links.backend_login') }}
                    </NuxtLink>
                    <button
                        @click="handleLogout"
                        v-if="isAuthenticated"
                        class="flex items-center gap-x-1"
                    >
                        {{ $t('links.logout') }}
                        <Icon class="text-xl" name="heroicons:arrow-right-on-rectangle-solid" />
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>