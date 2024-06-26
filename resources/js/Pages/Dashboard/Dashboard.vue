<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import HeaderReferral from './Partials/HeaderReferral.vue';
import WalletInfo from './Partials/WalletInfo.vue';
import ProductProgress from './Partials/ProductProgress.vue';
import {transactionFormat} from "@/Composables/index.js";
import { computed, ref } from 'vue';

const { formatAmount } = transactionFormat();

const user = usePage().props.auth.user;
const props = defineProps({
    walletIds: Object,
    robotecTransaction: Boolean,
    todayPamm: Number,
    autoTrades: Object,
    tradingAcc: Object,
    autoTradesCount: Number,
    pendingAutoTrade: Number,
});

const cumulativePamm = computed(() => {
    return props.autoTrades.reduce((sum, trade) => sum + trade.cumulative_pamm_return, 0);
})

const tradingAccBalance = ref(props.tradingAcc ? props.tradingAcc.balance : 0);

const handleDecimal = (value) => {
    const decimalPart = value.toString().split('.')[1];

    if (decimalPart) {
        if (decimalPart.length > 2) {
            return decimalPart.length;
        }
    }

    return 2;
}
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
                <HeaderReferral :user="user" :robotecTransaction="robotecTransaction" />
            </div>
        </template>

        <WalletInfo :walletIds="walletIds"/>

        <ProductProgress
            :robotecTransaction="robotecTransaction"
            :walletIds="walletIds"
            :autoTrades="autoTrades"
            :tradingAcc="tradingAcc"
            :autoTradesCount="autoTradesCount"
            :pendingAutoTrade="pendingAutoTrade"
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
                        :class="todayPamm > 0 ? 'text-success-500' : 'text-error-500'"
                    >
                        {{ formatAmount(todayPamm, handleDecimal(todayPamm)) }}
                    </div>
                </div>

                <div class="flex justify-between items-center self-stretch">
                    <div class="text-gray-300 text-sm font-medium">
                        {{ $t('public.culmulative_pamm_return') }} (%)
                    </div>
                    <div v-if="autoTrades" class="text-white text-right text-lg font-semibold">
                        {{ formatAmount(cumulativePamm, handleDecimal(cumulativePamm)) }}
                    </div>
                </div>

                <div class="flex justify-between items-center self-stretch">
                    <div class="text-gray-300 text-sm font-medium">
                        {{ $t('public.culmulative_earnings') }} ($)
                    </div>
                    <div class="text-white text-right text-lg font-semibold">
                        {{ formatAmount(tradingAccBalance, handleDecimal(tradingAccBalance)) }}
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
