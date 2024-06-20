<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import HeaderReferral from './Partials/HeaderReferral.vue';
import WalletInfo from './Partials/WalletInfo.vue';
import ProductProgress from './Partials/ProductProgress.vue';
import {transactionFormat} from "@/Composables/index.js";

const { formatAmount } = transactionFormat();

const user = usePage().props.auth.user;
const props = defineProps({
    walletIds: Object,
    robotecTransaction: Boolean,
    todayPamm: Object,
    cumulativePamm: Number,
    cumulativeEarnings: Number,
    autoTrades: Object,
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex py-2 justify-between items-center self-stretch">
                <div class="flex flex-col justify-center items-start">
                    <div class="self-stretch text-white text-xs font-medium">
                        {{ $t('public.welcome_back') }}
                    </div>
                    <div class="self-stretch text-white text-lg font-semibold">
                        {{ user.name }}
                    </div>
                </div>
                <HeaderReferral :user="user" :robotecTransaction="props.robotecTransaction" />
            </div>
        </template>

        <WalletInfo :walletIds="props.walletIds"/>

        <ProductProgress
            :robotecTransaction="props.robotecTransaction"
            :walletIds="props.walletIds"
            :autoTrades="props.autoTrades"
        />

        <div class="flex px-4 pt-5 pb-9 flex-col items-center self-stretch">
            <div class="flex py-2 items-center self-stretch text-white text-xl font-semibold">
                {{ $t('public.overview') }}
            </div>
            <div class="flex py-2 flex-col items-center gap-3 self-stretch">
                <div class="flex justify-between items-center self-stretch">
                    <div class="text-gray-300 text-sm font-medium">
                        {{ $t('public.today_pamm_return') }} (%)
                    </div>
                    <div
                        class="text-right text-lg font-semibold"
                        :class="props.todayPamm.value > 0 ? 'text-success-500' : 'text-error-500'"
                    >
                        {{ props.todayPamm.value }}
                    </div>
                </div>

                <div class="flex justify-between items-center self-stretch">
                    <div class="text-gray-300 text-sm font-medium">
                        {{ $t('public.culmulative_pamm_return') }} (%)
                    </div>
                    <div class="text-white text-right text-lg font-semibold">
                        {{ props.cumulativePamm }}
                    </div>
                </div>

                <div class="flex justify-between items-center self-stretch">
                    <div class="text-gray-300 text-sm font-medium">
                        {{ $t('public.culmulative_earnings') }} ($)
                    </div>
                    <div class="text-white text-right text-lg font-semibold">
                        {{ formatAmount(props.cumulativeEarnings) }}
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
