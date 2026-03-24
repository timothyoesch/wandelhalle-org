<script setup>
const {user, isAuthenticated, logout} = useSanctumAuth()
const localePath = useLocalePath()
async function handleLogout() {
    await logout()
    return navigateTo(localePath('/login'))
}
</script>
<template>
    <nav class="waha-navbar py-2 border-b-2 border-accent">
        <div class="waha-navbar__container px-4 md:px-8">
            <div class="waha-navbar__container--inner max-w-[85rem] mx-auto">
                <div class="waha-navbar__content flex justify-between items-center">
                    <div class="waha-navbar__logo flex gap-4 items-center">
                        <div class="w-40">
                            <NuxtLink to="/">
                                <AppLogo />
                            </NuxtLink>
                        </div>
                        <NuxtLink to="/" class="mt-6 font-light italic font-xl md:font-2xl">
                            <span>{{$t("app.name")}}</span>
                        </NuxtLink>
                    </div>
                    <div class="waha-navbar__links flex gap-2 flex-col items-end">
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
                            <button
                                @click="handleLogout"
                                v-if="isAuthenticated"
                            >
                                {{ $t('links.logout') }}
                            </button>
                        </div>
                        <div class="waha-navbar__links__lower flex font-bold gap-6 text-xl md:text-2xl">
                            <NuxtLink
                                :to="$localePath('/questions')"
                                :class="{
                                    'text-accent': $route.path.indexOf($localePath('/questions')) != -1,
                                }"
                            >
                                {{ $t('links.questions') }}
                            </NuxtLink>
                            <NuxtLink
                                :to="$localePath('/topics')"
                                :class="{
                                    'text-accent': $route.path.indexOf($localePath('/topics')) != -1,
                                }"
                            >
                                {{ $t('links.topics') }}
                            </NuxtLink>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>