<script setup>
import { ref, watchEffect } from 'vue';
import EmptyHistoryIllustration from '@/Pages/Dashboard/Partials/EmptyHistoryIllustration.vue';
import {transactionFormat} from "@/Composables/index.js";
import { usePage } from '@inertiajs/vue3';
import Loader from '@/Pages/Dashboard/Partials/Loader.vue';

const props = defineProps({
    walletIds: Object,
})

const { formatDateTime, formatAmount } = transactionFormat();
const isLoading = ref(false);
const transactions = ref('');
const empty = ref(false);

const getTransactions = async () => {
    try {
        isLoading.value = true;
        const response = await axios.get(route('getTransactions', props.walletIds.cash_wallet));
        transactions.value = response.data;
    } catch (error) {
        console.error('Error refreshing transactions data:', error);
    } finally {
        isLoading.value = false;
        if (transactions.value.length === 0) {
            empty.value = true;
        }
    }
};

getTransactions();

watchEffect(() => {
    if (usePage().props.title !== null || usePage().props.toast !== null) {
        getTransactions();
    }
});

</script>

<template>
    <div class="py-5">
        <div 
            v-if="!empty" 
            class="flex flex-col items-start self-stretch rounded-xl"
        >
            <template v-for="(transaction, index) in transactions">
                <div 
                    class="flex py-2 items-center gap-3 self-stretch border-b border-solid border-gray-700"
                    :class="{ 'border-transparent': index == Object.keys(transactions).length - 1 }"
                >
                    <div class="flex flex-col items-start flex-1">
                        <div class="text-gray-300 text-xs">
                            {{ formatDateTime(transaction.created_at) }}
                        </div>
                        <div class="max-w-48 self-stretch overflow-hidden text-white text-ellipsis whitespace-nowrap text-sm font-medium">
                            {{ $t('public.'+ transaction.transaction_type) }}
                        </div>
                    </div>
                    <div 
                        class="min-w-fit text-right font-medium"
                    >
                        <span v-if="transaction.to_wallet_id" class="text-success-500">
                            + $ {{ formatAmount(transaction.amount) }}
                        </span>
                        <span v-else class="text-white">
                            - $ {{ formatAmount(transaction.amount) }}
                        </span>
                    </div>
                </div>
            </template>

            <div
                v-if="isLoading"
                class="flex flex-col items-center self-stretch text-white text-center tetx-sm font-medium"
            >
                <Loader />
            </div>
        </div>

        <div
            v-else
            class="flex py-5 flex-col items-center gap-3 self-stretch"
        >
            <EmptyHistoryIllustration />
            <div class="self-stretch text-gray-300 text-center text-sm">
                {{ $t('public.no_transaction') }}
            </div>
        </div>
    </div>
</template>