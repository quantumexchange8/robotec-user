<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import {onUpdated, ref, watch} from "vue";
import Button from '@/Components/Button.vue';
import Input from '@/Components/Input.vue';
import Label from '@/Components/Label.vue';
import InputError from '@/Components/InputError.vue';
import Modal from '@/Components/Modal.vue';
import CompleteStep2Illustration from '@/Pages/Withdrawal/Partials/CompleteStep2Illustration.vue';
import WithdrawalHistory from '@/Pages/Withdrawal/Partials/WithdrawalHistory.vue'
import AddUSDTButton from '@/Pages/Profile/Partials/AddUSDTButton.vue';
import AddUSDTAddressForm from '@/Pages/Profile/Partials/AddUSDTAddressForm.vue';
import {transactionFormat} from "@/Composables/index.js";

const props = defineProps({
    commissionWallet: Object,
    withdrawalHistory: Array,
});

const step2 = true;
const commissionWalletBal = ref(props.commissionWallet.balance);
const amountButton = ref('full_amount');
const is_disabled = ref(true);
const withdrawalAmount = ref(null);
const page = usePage();
const usdtAddress = ref(page.props.auth.user.usdt_address);
const { formatAmount } = transactionFormat();

onUpdated(() => {
    usdtAddress.value = page.props.auth.user.usdt_address;
})

const fullOrClear = () => {
    if (amountButton.value === 'full_amount') {
        withdrawalAmount.value = parseFloat(commissionWalletBal.value);
    } else if (amountButton.value === 'clear') {
        withdrawalAmount.value = null;
    }
}

const feeCharge = ref('0.00');
const receivable = ref('0.00')

watch(withdrawalAmount, (newValue) => {
    if (newValue !== null) {
        amountButton.value = 'clear';
    } else {
        amountButton.value = 'full_amount';
    }

    if (newValue >= 250 && usdtAddress) {
        is_disabled.value = false;
        feeCharge.value = (newValue * 0.1).toFixed(2);
        receivable.value = (newValue - feeCharge.value).toFixed(2);
    } else {
        is_disabled.value = true;
        feeCharge.value = '0.00';
        receivable.value = '0.00';
    }
});

const withdrawalModal = ref(false);
const modalComponent = ref('');

const openWithdrawalModal = (modalType) => {
    withdrawalModal.value = true;

    if (modalType === 'withdrawal_history') {
        modalComponent.value = modalType;
    } else if (modalType === 'add_usdt_address') {
        modalComponent.value = modalType;
    }
}

const closeModal = () => {
    withdrawalModal.value = false
}

const form = useForm({
    amount: null,
    charges: null,
    receivable: null,
    usdt: '',
});

const submitForm = () => {
    form.amount = withdrawalAmount.value;
    form.charges = feeCharge.value;
    form.receivable = receivable.value;
    form.usdt = usdtAddress.value;

    form.post(route('transaction.withdrawal.store'), {
        preserveScroll: true,
        onSuccess: () => {
            withdrawalAmount.value = null;
        },
    });
}

watch(() => props.commissionWallet, (newWalletValue) => {
    commissionWalletBal.value = newWalletValue.balance;
})

</script>

<template>
    <Head title="Withdrawal Request" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="flex-1 text-white text-xl">{{ $t('public.withdrawal') }}</h2>
        </template>

        <form 
            v-if="step2"
            @submit.prevent="submitForm"
        >
            <div class="flex px-4 pb-2 flex-col items-start gap-8 self-stretch">
                <Button
                    variant="gray"
                    type="button"
                    class="font-semibold"
                    @click="openWithdrawalModal('withdrawal_history')"
                >
                    {{ $t('public.view_withdrawal_history') }}
                </Button>
                <div class="flex py-8 px-5 flex-col justify-center items-center gap-3 self-stretch rounded-2xl bg-gray-800">
                    <div class="flex flex-col items-center">
                        <div class="text-white text-center font-semibold">{{ $t('public.commission_wallet_balance') }}</div>
                        <div class="text-gray-300 text-center text-xs">{{ $t('public.min_withdrawal_amount') }}</div>
                    </div>
                    <div class="text-white text-center text-xxl font-semibold">$ {{ formatAmount(commissionWalletBal) }}</div>
                </div>
                <div class="flex flex-col items-center gap-5 self-stretch">
                    <div class="flex flex-col items-start gap-1.5 self-stretch">
                        <Label for="amount" :value="$t('public.amount')" :invalid="form.errors.amount" />
                        <div class="relative w-full">
                            <Input
                                v-model="withdrawalAmount"
                                id="amount"
                                type="text"
                                class="block w-full pr-32"
                                placeholder="$ 0.00"
                                :invalid="form.errors.amount"
                            />
                            <Button
                                variant="transparent"
                                type="button"
                                class="max-w-fit absolute top-1 right-0 font-semibold"
                                @click="fullOrClear"
                            >
                                <div :class="{'text-error-500': amountButton === 'clear'}">
                                    {{ $t('public.'+ amountButton) }}
                                </div>
                            </Button>
                        </div>
                        <InputError :message="form.errors.amount" />
                    </div>
                    <div class="flex flex-col items-start gap-1.5 self-stretch">
                        <Label for="usdt" :invalid="form.errors.usdt">
                            {{ $t('public.usdt_address') }}
                        </Label>
                        <Input
                            v-if="usdtAddress"
                            v-model="usdtAddress"
                            id="usdt"
                            type="text"
                            :is_disabled="true"
                            class="block w-full"
                            :placeholder="usdtAddress"
                            :invalid="form.errors.usdt"
                        />
                        <AddUSDTButton v-else @update:usdtForm="openWithdrawalModal($event)" />
                        <InputError :message="form.errors.usdt" />
                    </div>
                </div>

                <div class="self-stretch border-b border-solid border-gray-700 flex-1"></div>

                <div class="flex flex-col items-center gap-2 self-stretch">
                    <div class="flex items-center gap-3 self-stretch">
                        <div class="text-gray-300 text-xs">{{ $t('public.fee_charges') }} (10%)</div>
                        <div class="flex-1 text-white text-sm font-medium">$ {{ feeCharge }}</div>
                    </div>
                    <div class="flex items-center gap-3 self-stretch">
                        <div class="text-gray-300 text-xs">{{ $t('public.receivable_amount') }}</div>
                        <div class="flex-1 text-white text-sm font-medium">$ {{ receivable }}</div>
                    </div>
                </div>
                <Button
                    size="lg"
                    :disabled="is_disabled || form.processing"
                    class="block w-full font-semibold"
                >
                    {{ $t('public.withdraw_now') }}
                </Button>
            </div>
        </form>

        <div 
            v-else 
            class="flex py-5 px-4 flex-col items-center gap-5 self-stretch"
        >
            <CompleteStep2Illustration />
            <div class="flex flex-col items-center gap-2 self-stretch">
                <div class="text-white text-center font-semibold">
                    {{ $t('public.withdraw_not_available') }}
                </div>
                <div class="self-stretch text-gray-300 text-center text-sm">
                    {{ $t('public.withdraw_not_available_desc') }}
                </div>
            </div>
        </div>

        <Modal
            :show="withdrawalModal"
            :title="$t('public.'+ modalComponent)"
            @close="closeModal"
        >
            <template v-if="modalComponent === 'withdrawal_history'">
                <WithdrawalHistory :withdrawalHistory=props.withdrawalHistory />
            </template>

            <template v-if="modalComponent === 'add_usdt_address'">
                <AddUSDTAddressForm @update:modal="withdrawalModal = $event"/>
            </template>
        </Modal>
    </AuthenticatedLayout>
</template>
