<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import {ref, watch} from "vue";
import TanStackTable from '@/Components/TanStackTable.vue';
import Button from '@/Components/Button.vue';
import Input from '@/Components/Input.vue';
import Label from '@/Components/Label.vue';
import InputError from '@/Components/InputError.vue';
import CompleteStep2Illustration from './Partials/CompleteStep2Illustration.vue';

const usdtAddress = 'abc';
const step2 = true;

const is_disabled = ref(true);
const form = useForm({
    amount: null,
    usdt: '',
});

const submitForm = () => {
    console.log('submitting');
    is_disabled.value = form.processing;
}
</script>

<template>
    <Head title="Withdrawal Request" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="flex-1 text-white text-xl">Withdrawal</h2>
        </template>

        <div v-if="step2">
            <form @submit.prevent="submitForm">
                <div class="flex px-4 pb-2 flex-col items-start gap-8 self-stretch">
                    <Button
                        variant="gray"
                        type="button"
                        class="font-semibold"
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
                                v-model="form.amount"
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
                                v-model="form.usdt"
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
                            <div class="flex-1 text-white text-sm font-medium">$ 0.00</div>
                        </div>
                        <div class="flex items-center gap-3 self-stretch">
                            <div class="text-gray-300 text-xs">Receivable Amount</div>
                            <div class="flex-1 text-white text-sm font-medium">$ 0.00</div>
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
        </div>
        <div v-else>
            <div class="flex py-5 px-4 flex-col items-center gap-5 self-stretch">
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
        </div>
    </AuthenticatedLayout>
</template>
