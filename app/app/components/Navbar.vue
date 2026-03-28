<script setup>
const {user, isAuthenticated, logout} = useSanctumAuth()
const localePath = useLocalePath()
const config = useRuntimeConfig()
const adminUrl = config.public.apiUrl + '/admin'

async function handleLogout() {
    await logout()
    return navigateTo(localePath('/login'))
}

const mobileMenuOpen = ref(false)

watch(() => useRoute().path, () => {
    if (mobileMenuOpen.value) {
        mobileMenuOpen.value = false
    }
})

</script>
<template>
    <div class="waha-navbar__base-container">
        <nav class="waha-navbar py-2 md:py-4 border-b-2 border-accent-500 relative z-20">
            <div class="waha-navbar__container px-4 md:px-8">
                <div class="waha-navbar__container--inner max-w-[85rem] mx-auto">
                    <div class="waha-navbar__content flex justify-between items-center">
                        <div class="waha-navbar__logo flex flex-col gap-0 items-center">
                            <div class="w-16 md:w-40">
                                <NuxtLink to="/">
                                    <AppLogo />
                                </NuxtLink>
                            </div>
                            <NuxtLink to="/" class="font-light italic text-xs md:text-2xl">
                                <span>{{$t("app.name")}}</span>
                            </NuxtLink>
                        </div>
                        <div class="waha-navbar__links gap-2 flex-col items-end hidden md:flex">
                            <div class="waha-navbar__links__upper flex text-xs md:text-sm gap-4">
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
                            <div class="waha-navbar__links__lower flex font-bold gap-6 text-xl md:text-2xl">
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
                        </div>
                        <div
                            class="waha-navbar__mobile-menu md:hidden flex items-center gap-x-1 cursor-pointer"
                            v-on:click="mobileMenuOpen = !mobileMenuOpen"
                        >
                            <Icon
                                name="heroicons:bars-3-solid"
                                v-if="!mobileMenuOpen"
                                class="text-2xl" />
                            <Icon
                                name="heroicons:x-mark-solid"
                                v-if="mobileMenuOpen"
                                class="text-2xl"
                            />
                            <p>{{ $t('links.mobile_menu') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <MobileMenu
            :menuOpen="mobileMenuOpen"
        />
    </div>
</template>