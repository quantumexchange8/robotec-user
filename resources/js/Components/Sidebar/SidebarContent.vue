<script setup>
import PerfectScrollbar from '@/Components/PerfectScrollbar.vue'
import SidebarLink from '@/Components/Sidebar/SidebarLink.vue'
// import { DashboardIcon, CoinsHandIcon, ReportIcon, Wallet01Icon } from '@/Components/Icons/outline'
import SidebarCollapsible from '@/Components/Sidebar/SidebarCollapsible.vue'
import SidebarCollapsibleItem from '@/Components/Sidebar/SidebarCollapsibleItem.vue'
// import { TemplateIcon, ViewGridIcon, SwitchHorizontalIcon, UserGroupIcon, UserIcon } from '@heroicons/vue/outline'
import { HomeIcon, UserCircleIcon, GlobeAltIcon, Users01Icon, CoinsHandIcon, Speedometer04, CreditCardEditIcon, CreditCardDownloadIcon } from '@/Components/Icons/outline'
</script>

<template>
    <PerfectScrollbar
        tagname="nav"
        aria-label="main"
        class="relative flex flex-col flex-1 max-h-full gap-4 px-3"
    >
        <SidebarLink
            :title="$t('public.dashboard')"
            :href="route('dashboard')"
            :active="route().current('dashboard')"
        >
            <template #icon>
                <HomeIcon
                    class="flex-shrink-0 w-5 h-5"
                    aria-hidden="true"
                />
            </template>
        </SidebarLink>

        <SidebarLink
            :title="$t('public.client_data')"
            :href="route('clientData')"
            :active="route().current('clientData')"
        >
            <template #icon>
                <Users01Icon
                    class="flex-shrink-0 w-5 h-5"
                    aria-hidden="true"
                />
            </template>
        </SidebarLink>

        <SidebarLink
            :title="$t('public.withdrawal')"
            :href="route('transaction.withdrawal')"
            :active="route().current('transaction.withdrawal')"
        >
            <template #icon>
                <CreditCardDownloadIcon
                    class="flex-shrink-0 w-5 h-5"
                    aria-hidden="true"
                />
            </template>
        </SidebarLink>

        <SidebarLink
            :title="$t('public.my_profile')"
            :href="route('profile.edit')"
            :active="route().current('profile.edit')"
        >
            <template #icon>
                <UserCircleIcon
                    class="flex-shrink-0 w-5 h-5"
                    aria-hidden="true"
                />
            </template>
        </SidebarLink>

    </PerfectScrollbar>
</template>
