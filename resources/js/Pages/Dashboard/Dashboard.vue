<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import HeaderReferral from './Partials/HeaderReferral.vue';
import WalletInfo from './Partials/WalletInfo.vue';
import ProductProgress from './Partials/ProductProgress.vue';

const user = usePage().props.auth.user;
const props = defineProps({
    walletIds: Object,
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex py-2 justify-between items-center self-stretch">
                <div class="flex flex-col justify-center items-start">
                    <div class="self-stretch text-white text-xs font-medium">{{ $t('public.welcome_back') }}</div>
                    <div class="self-stretch text-white text-lg font-semibold">{{ user.name }}</div>
                </div>
                <HeaderReferral :user="user" />
            </div>
        </template>

        <WalletInfo :walletIds="props.walletIds"/>

        <ProductProgress />

        <div class="flex px-4 py-5 flex-col items-center self-stretch">
            <div class="flex py-2 items-center self-stretch text-white text-xl font-semibold">{{ $t('public.overview') }}</div>
            <div class="flex py-2 flex-col items-center gap-3 self-stretch">
                <div class="flex justify-between items-center self-stretch">
                    <div class="text-gray-300 text-sm font-medium">{{ $t('public.today_pamm_return') }} (%)</div>
                    <div class="text-success-500 text-right text-lg font-semibold">2.19</div>
                </div>

                <div class="flex justify-between items-center self-stretch">
                    <div class="text-gray-300 text-sm font-medium">{{ $t('public.culmulative_pamm_return') }} (%)</div>
                    <div class="text-white text-right text-lg font-semibold">0</div>
                </div>

                <div class="flex justify-between items-center self-stretch">
                    <div class="text-gray-300 text-sm font-medium">{{ $t('public.culmulative_earnings') }} ($)</div>
                    <div class="text-white text-right text-lg font-semibold">0</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
