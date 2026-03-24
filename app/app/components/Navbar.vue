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
                        <div class="waha-navbar__links__upper flex text-xs gap-4">
                            <NuxtLink :to="$t('links.register.slug')">
                                {{ $t('links.register.label') }}
                            </NuxtLink>
                            <NuxtLink :to="$t('links.login.slug')">
                                {{ $t('links.login.label') }}
                            </NuxtLink>
                        </div>
                        <div class="waha-navbar__links__lower flex font-bold gap-6">
                            <NuxtLink
                                :to="$t('links.questions.slug')"
                                :class="{
                                    'text-accent': $route.path.indexOf($t('links.questions.slug')) != -1,
                                }"
                            >
                                {{ $t('links.questions.label') }}
                            </NuxtLink>
                            <NuxtLink
                                :to="$t('links.topics.slug')"
                                :class="{
                                    'text-accent': $route.path.indexOf($t('links.topics.slug')) != -1,
                                }"
                            >
                                {{ $t('links.topics.label') }}
                            </NuxtLink>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>