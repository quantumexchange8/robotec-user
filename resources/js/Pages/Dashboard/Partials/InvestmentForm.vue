<script setup>
import Label from '@/Components/Label.vue';
import Button from '@/Components/Button.vue';
import InputError from '@/Components/InputError.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { ref, watchEffect } from 'vue';
import {RadioGroup, RadioGroupLabel, RadioGroupOption} from "@headlessui/vue";
import {transactionFormat} from "@/Composables/index.js";

const props = defineProps({
    modalType: String,
    walletIds: Object,
});

const { formatAmount } = transactionFormat();

const cashWallet = ref(null);
const commissionWallet = ref(null);

const getWallets = async () => {
    try {
        const response = await axios.get('/getWallets', {
            params: {
                cash_wallet_id: props.walletIds.cash_wallet,
                commission_wallet_id: props.walletIds.commission_wallet,
            }
        });
        cashWallet.value = response.data.cashWalletBalance;
        commissionWallet.value = response.data.commissionWalletBalance;
    } catch (error) {
        console.error('Error refreshing wallets data:', error);
    }
};

getWallets();

watchEffect(() => {
    if (usePage().props.title !== null) {
        getWallets();
    }
});

const emit = defineEmits([
    'update:productProgressModal',
    'update:button2'
]);

const form = useForm({
    wallet: 'cash_wallet',
    amount: '',
    type: props.modalType
});

const submitForm = () => {
    form.post(route('trading.investment'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            closeModal();
            if (props.modalType === 'fund_in') {
                emit('update:button2', 'start_auto_trading');
            }
        },
    });
}

const closeModal = () => {
    emit('update:productProgressModal', false)
}

const amounts = [
    {
        name: '$ 250',
        value: '250',
    },
    {
        name: '$ 500',
        value: '500',
    },
    {
        name: '$ 750',
        value: '750',
    },
    {
        name: '$ 1,000',
        value: '1000',
    },
]
</script>

<template>
    <form class="py-5" @submit.prevent="submitForm">
        <div class="flex flex-col items-center gap-5 self-stretch">
            <div class="flex flex-col items-start gap-1.5 self-stretch">
                <Label for="select_wallet" :value="$t('public.select_wallet')" :invalid="form.errors.wallet" />
                <div class="px-1 flex flex-col items-start gap-3">
                    <div class="flex items-center gap-3">
                        <input
                            type="radio"
                            id="cash_wallet"
                            value="cash_wallet"
                            v-model="form.wallet"
                            checked
                            class="bg-gray-900 border-gray-600 text-primary-500 focus:ring-primary-500 focus:ring-offset-gray-900"
                        />
                        <label for="cash_wallet" class="text-white text-sm font-semibold">
                            {{ $t('public.cash_wallet') }}
                        </label>
                        <div class="text-gray-300 text-xs font-medium">
                            {{ $t('public.balance') }}:
                            <template v-if="cashWallet !== null">
                                $ {{ formatAmount(cashWallet) }}
                            </template>
                            <template v-else class="text-md">
                                {{ $t('public.loading') }}
                            </template>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <input
                            type="radio"
                            id="commission_wallet"
                            value="commission_wallet"
                            v-model="form.wallet"
                            class="bg-gray-900 border-gray-600 text-primary-500 focus:ring-primary-500 focus:ring-offset-gray-900"
                        />
                        <label for="commission_wallet" class="text-white text-sm font-semibold">
                            {{ $t('public.commission_wallet') }}
                        </label>
                        <div class="text-gray-300 text-xs font-medium">
                            {{ $t('public.balance') }}:
                            <template v-if="commissionWallet !== null">
                                $ {{ formatAmount(commissionWallet) }}
                            </template>
                            <template v-else class="text-md">
                                {{ $t('public.loading') }}
                            </template>
                        </div>
                    </div>
                </div>
                <InputError :message="form.errors.wallet" />
            </div>

            <div class="flex flex-col gap-1.5 self-stretch items-stretch">
                <Label for="amount" :value="$t('public.fund_in_amount')" :invalid="form.errors.amount" />

                <RadioGroup v-model="form.amount">
                    <RadioGroupLabel class="sr-only">{{ $t('public.fund_in_amount') }}</RadioGroupLabel>
                    <div class="grid grid-cols-2 gap-3 w-full self-stretch">
                        <RadioGroupOption
                            as="template"
                            v-for="(amount, index) in amounts"
                            :key="index"
                            :value="amount.value"
                            v-slot="{ active, checked }"
                        >
                            <div
                                :class="[
                                    active
                                        ? 'ring-0 ring-white ring-offset-0'
                                        : '',
                                    checked ? 'border-primary-500 bg-gray-900 shadow-[0_0_20px_0_rgba(0,10,255,0.40)_inset]' : 'border-gray-600 bg-gray-900',
                        ]"
                                class="relative flex cursor-pointer rounded-xl border py-6 px-3 focus:outline-none w-full"
                            >
                                <div class="flex items-center w-full">
                                    <div class="text-sm flex flex-col gap-3 w-full">
                                        <RadioGroupLabel
                                            as="div"
                                            class="text-white text-xl font-semibold"
                                        >
                                            <div class="flex justify-center items-center gap-3">
                                                {{ amount.name }}
                                            </div>
                                        </RadioGroupLabel>
                                    </div>
                                </div>
                            </div>
                        </RadioGroupOption>
                    </div>

                </RadioGroup>
                <InputError :message="form.errors.amount" />
            </div>

            <div
                v-if="props.modalType === 'top_up_capital'"
                class="self-stretch text-neutral-400 text-xs"
            >
                <div class="flex flex-col gap-4">
                    <div>{{ $t('public.top_up_desc_1') }}</div>
                    <div>{{ $t('public.top_up_desc_2') }}</div>
                </div>
            </div>

            <div class="flex pt-8 items-center gap-3 self-stretch">
                <Button
                    variant="outline"
                    size="lg"
                    type="button"
                    class="w-full font-semibold"
                    @click="closeModal"
                >
                    {{ $t('public.cancel') }}
                </Button>

                <Button
                    size="lg"
                    class="w-full font-semibold"
                    :disabled="form.processing"
                >
                    {{ $t('public.confirm') }}
                </Button>
            </div>
        </div>
    </form>
</template>