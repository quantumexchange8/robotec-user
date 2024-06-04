<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import {ref, watch} from "vue";
import Button from '@/Components/Button.vue';
import Input from '@/Components/Input.vue';
import Label from '@/Components/Label.vue';
import InputError from '@/Components/InputError.vue';
import Modal from '@/Components/Modal.vue';
import CompleteStep2Illustration from '@/Pages/Withdrawal/Partials/CompleteStep2Illustration.vue';
import WithdrawalHistory from '@/Pages/Withdrawal/Partials/WithdrawalHistory.vue'

const step2 = true;
const is_disabled = ref(true);
const usdtAddress = ref('asd');
const withdrawalAmount = ref('');

const form = useForm({
    amount: null,
    usdt: '',
});

const submitForm = () => {
    form.amount = withdrawalAmount;
    form.usdt = usdtAddress;
    is_disabled.value = form.processing;

    // form.put(route(''), {
    //     preserveScroll: true,
    //     onSuccess: () => form.reset(),
    //     onError: () => {
    //         if (form.errors.amount) {
    //             form.reset();
    //         }
    //     },
    // });
}

const feeCharge = ref('0.00');
const receivable = ref('0.00')

watch(withdrawalAmount, (newValue) => {
    if (withdrawalAmount.value.length > 0 && usdtAddress.value) {
        is_disabled.value = false;
    } else {
        is_disabled.value = true;
    }

    if (newValue >= 250) {
        feeCharge.value = (newValue * 0.1).toFixed(2);
        receivable.value = (newValue - feeCharge.value).toFixed(2);
    } else {
        feeCharge.value = '0.00';
        receivable.value = '0.00';
    }
});

const withdrawalModal = ref(false);
const modalComponent = ref('');

const openWithdrawalModal = (modalType) => {
    withdrawalModal.value = true;
    modalComponent.value = modalType;
}

const closeModal = () => {
    withdrawalModal.value = false
}

</script>

<template>
    <Head title="Withdrawal Request" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="flex-1 text-white text-xl">Withdrawal</h2>
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
                    View Withdrawal History
                </Button>
                <div class="flex py-8 px-5 flex-col justify-center items-center gap-3 self-stretch rounded-2xl bg-gray-800">
                    <div class="flex flex-col items-center">
                        <div class="text-white text-center font-semibold">Commision Wallet Balance</div>
                        <div class="text-gray-300 text-center text-xs">Min withdrawal amount: $ 250</div>
                    </div>
                    <div class="text-white text-center text-xxl font-semibold">$ 300.00</div>
                </div>
                <div class="flex flex-col items-center gap-5 self-stretch">
                    <div class="flex flex-col items-start gap-1.5 self-stretch">
                        <Label for="amount" value="Amount"/>
                        <Input
                            v-model="withdrawalAmount"
                            id="amount"
                            type="text"
                            class="block w-full"
                            placeholder="$ 0.00"
                        />
                        <InputError :message="form.errors.amount" />
                    </div>
                    <div class="flex flex-col items-start gap-1.5 self-stretch">
                        <Label for="usdt" value="USDT Address" :is_required="false" />
                        <Input
                            v-model="usdtAddress"
                            id="usdt"
                            type="text"
                            :is_disabled="true"
                            class="block w-full"
                            :placeholder="usdtAddress ? usdtAddress : '-'"
                        />
                        <InputError :message="form.errors.usdt" />
                        <div v-if="!usdtAddress" class="self-stretch text-gray-300 text-xs">
                            You haven't set up your USDT address yet. Please add one in "My Profile" to enable smooth transactions.
                        </div>
                    </div>
                </div>

                <div class="self-stretch border-b border-solid border-gray-700 flex-1"></div>

                <div class="flex flex-col items-center gap-2 self-stretch">
                    <div class="flex items-center gap-3 self-stretch">
                        <div class="text-gray-300 text-xs">Fee Charges (10%)</div>
                        <div class="flex-1 text-white text-sm font-medium">$ {{ feeCharge }}</div>
                    </div>
                    <div class="flex items-center gap-3 self-stretch">
                        <div class="text-gray-300 text-xs">Receivable Amount</div>
                        <div class="flex-1 text-white text-sm font-medium">$ {{ receivable }}</div>
                    </div>
                </div>
                <Button
                    size="lg"
                    :disabled="is_disabled"
                    class="block w-full font-semibold"
                >
                    Withdraw Now
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
                    Withdrawal Not Available
                </div>
                <div class="self-stretch text-gray-300 text-center text-sm">
                    Almost there! You need to complete Step 2 before you can make a withdrawal. Finish up Step 2 and you'll be all set!
                </div>
            </div>
        </div>

        <Modal
            :show="withdrawalModal"
            :title="modalComponent"
            @close="closeModal"
        >
            <WithdrawalHistory />
        </Modal>
    </AuthenticatedLayout>
</template>
