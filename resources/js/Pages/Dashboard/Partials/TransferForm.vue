<script setup>
import Button from '@/Components/Button.vue';
import { ArrowNarrowUpRightIcon } from '@/Components/Icons/outline';
import { useForm } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import {transactionFormat} from "@/Composables/index.js";

const { formatAmount } = transactionFormat();

const props = defineProps({
    autoTrades: Object,
    index: Number,
    tradingAcc: Object,
});

const emit = defineEmits([
    'update:productProgressModal',
    'update:button2'
]);

const closeModal = () => {
    emit('update:productProgressModal', false);
}
const trade = props.autoTrades[props.index];
const bal = ref(parseFloat(trade.investment_amount) + parseFloat(trade.cumulative_amount));
const fundIn = ref(parseInt(trade.investment_amount));

const percentage = computed(() => {
    return (bal.value - fundIn.value) / fundIn.value * 100;
});

const form = useForm({
    auto_trade_id: '',
});

const submitForm = () => {
    form.auto_trade_id = trade.id;

    form.post(route('trading.transfer'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            closeModal();
        },
    });
}

</script>

<template>
    <div class="pt-5 flex flex-col items-center gap-5">
        <div class="flex flex-col items-center gap-5 self-stretch">
            <div class="flex py-8 px-5 flex-col justify-center items-center gap-3 self-stretch rounded-2xl bg-gray-800">
                <div class="text-gray-300 text-center font-semibold">{{ $t('public.current_account_balance') }}</div>
                <div class="flex justify-center items-center gap-3">
                    <div class="text-white text-center text-xxl font-semibold">
                        $ {{ formatAmount(bal) }}
                    </div>
                    <div class="flex items-center gap-1">
                        <ArrowNarrowUpRightIcon />
                        <div class="text-success-500 text-center text-sm font-medium">
                            {{ formatAmount(percentage) }} %
                        </div>
                    </div>
                </div>
            </div>

            <div class="self-stretch text-neutral-400 text-xs">
                {{ $t('public.transfer_desc') }}
            </div>

            <div class="flex pt-8 items-center gap-3 self-stretch">
                <Button
                    variant="outline"
                    size="lg"
                    type="button"
                    class="w-full font-semibold"
                    :disabled="form.processing"
                    @click="closeModal"
                >
                    {{ $t('public.cancel') }}
                </Button>

                <Button
                    size="lg"
                    type="button"
                    class="w-full font-semibold"
                    :disabled="form.processing"
                    @click="submitForm"
                >
                    {{ $t('public.transfer_now') }}
                </Button>
            </div>
        </div>
    </div>
</template>