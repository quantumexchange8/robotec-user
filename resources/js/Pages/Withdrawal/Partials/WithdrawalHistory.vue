<script setup>
import EmptyHistoryIllustration from '@/Pages/Dashboard/Partials/EmptyHistoryIllustration.vue';
import {transactionFormat} from "@/Composables/index.js";

const { formatDateTime, formatAmount } = transactionFormat();

const props = defineProps({
    withdrawalHistory:Array,
});

</script>

<template>
    <div class="pt-5">
        <template v-if="props.withdrawalHistory.length">
            <div
                v-for="withdrawalHistory in props.withdrawalHistory"
                class="flex py-2 items-center gap-3 self-stretch"
            >
                <div class="flex flex-col items-start flex-1">
                    <div class="text-gray-300 text-xs">{{ formatDateTime(withdrawalHistory.created_at) }}</div>
                    <div
                        v-if="withdrawalHistory.status === 'success'"
                        class="text-success-500 text-sm font-medium"
                    >
                        {{ $t('public.success') }}
                    </div>
                    <div
                        v-else-if="withdrawalHistory.status === 'processing'"
                        class="text-warning-500 text-sm font-medium"
                    >
                        {{ $t('public.processing') }}
                    </div>
                    <div
                        v-else-if="withdrawalHistory.status === 'failed'"
                        class="text-error-500 text-sm font-medium"
                    >
                        {{ $t('public.failed') }}
                    </div>
                </div>
                <div class="text-white text-right font-medium">$ {{ formatAmount(withdrawalHistory.amount) }}</div>
            </div>
        </template>

        <div 
            v-else 
            class="flex py-5 flex-col items-center gap-3 self-stretch"
        >
            <EmptyHistoryIllustration />
            <div class="self-stretch text-gray-300 text-center text-sm">
                {{ $t('public.no_history_found') }}
            </div>
        </div>
    </div>
</template>
