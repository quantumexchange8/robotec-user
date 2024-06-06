<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Copy01Icon } from '@/Components/Icons/outline';
import { TetherIcon } from '@/Components/Icons/brands';
import Qrcode from "qrcode.vue";
import InputError from '@/Components/InputError.vue';
import { Head, useForm } from '@inertiajs/vue3';
import Input from '@/Components/Input.vue';
import Label from '@/Components/Label.vue';
import Button from '@/Components/Button.vue';
import { computed, onMounted, ref, watch } from "vue";

const is_disabled = ref(true);
const amount = ref('');
const txId = ref('');

const walletAddressesSelect = ["Lorem, ipsum dolor sit amet consectetur adipisicing elit.", "Officia earum eveniet dignissimos ex debitis, hic repudiandae mollitia fugiat?", "Lorem ipsum dolor sit amet consectetur adipisicing elit."];
const addressLength = walletAddressesSelect.length;
let currentIndex = 0;
const qrAddress = ref(walletAddressesSelect[currentIndex]);

//timer countdown
const totalTime = 300;
const currentTime = ref(totalTime);

const formatTime = computed(() => {
    const minutes = Math.floor(currentTime.value / 60);
    const seconds = currentTime.value % 60;
    return `${String(minutes)}:${String(seconds).padStart(2, '0')}`;
});

const countdown = () => {
    if (currentTime.value > 0) {
        setTimeout(() => {
            currentTime.value--;
            countdown();
        }, 1000);
    }
};

// when timeout, change to next wallet address and reset timer
watch(currentTime, (newValue) => {
    if (newValue === 0) {
        currentIndex = (currentIndex + 1) % addressLength;
        qrAddress.value = walletAddressesSelect[currentIndex];
        setTimeout(() => {
            currentTime.value = totalTime;
            countdown();
        }, 1000);
    }
})

onMounted(() => {
    countdown();
});

// copy the wallet address to clipboard
const hoverCopy = ref(false);
const copyCode = () => {
    const walletCode = document.querySelector('#WalletCode').textContent;

    const tempInput = document.createElement('input');
    tempInput.value = walletCode;
    document.body.appendChild(tempInput);
    tempInput.select();
    document.execCommand('copy');
    document.body.removeChild(tempInput);

    setTimeout(function () {
        hoverCopy.value = false;
    }, 3000);
}

const form = useForm({
    depositAmount: null,
    txid: '',
});

const submitForm = () => {
    form.depositAmount = amount;
    form.txid = txId;
    return;

    is_disabled = form.processing;
    form.post(route('dashboard.deposit'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        },
        onError: () => {
            if (form.errors.depositAmount) {
                form.reset('depositAmount');
            }
            if (form.errors.txid) {
                form.reset('txid');
            }
        }
    })
}

const buttonStatus = () => {
    if (amount.value && txId.value) {
        is_disabled.value = false;
    } else {
        is_disabled.value = true;
    }
}

watch(amount, () => {
    buttonStatus();
});

watch(txId, () => {
    buttonStatus();
});

// watch checkbox to true

</script>

<template>
    <Head title="Deposit" />

    <AuthenticatedLayout>
        <div class="flex py-3 px-4 flex-col items-center gap-3">
            <div class="py-2 items-center self-stretch text-white text-xl font-semibold">{{ $t('public.deposit') }}</div>
            
            <form @submit.prevent="submitForm">
                <div class="flex flex-col items-center gap-8 self-stretch">
                    <div class="flex p-5 flex-col items-center gap-2 self-stretch rounded-2xl bg-gray-800">
                        <div class="flex items-center gap-3">
                            <TetherIcon />
                            <div class="text-white text-lg font-semibold uppercase">trc20</div>
                        </div>
                        <div class="text-gray-300 text-center text-xs">
                            {{ $t('public.qr_countdown_desc') }}
                        </div>
                        <div id="time" class="text-error-500 text-center text-sm font-semibold">
                            {{ formatTime }} {{ $t('public.minutes') }} 
                        </div>
                        <div class="shrink-0">
                            <Qrcode :value="qrAddress" :size="160" render-as="svg" :margin="1" level="M" background="#F7F7F7" />
                        </div>
                        <div class="flex justify-center items-center gap-2 self-stretch flex-wrap">
                            <div class="text-gray-300 text-xxs" id="WalletCode">
                                {{ qrAddress }}
                            </div>
                            <div class="relative" @click="hoverCopy = true" @mouseleave="hoverCopy = false">
                                <Copy01Icon class="text-bilbao-700 hover:cursor-pointer hover:text-bilbao-800 focus:text-bilbao-900" @click="copyCode" />
                                <div
                                    v-show="hoverCopy"
                                    id="copied_success"
                                    class="w-32 -left-16 absolute bottom-4 p-1 mb-2 text-sm text-center text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 transition ease-in-out"
                                >
                                    {{ $t('public.copied') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col items-start gap-1.5 self-stretch">
                        <Label for="deposit_amount" :value="$t('public.deposit_amount')" :invalid="form.errors.depositAmount" />
                        <Input
                            v-model="amount"
                            id="deposit_amount"
                            type="text"
                            class="block w-full"
                            placeholder="$ 0.00"
                            :invalid="form.errors.depositAmount"
                        />
                        <InputError :message="form.errors.depositAmount" />
                    </div>
                    <div class="flex flex-col items-start gap-1.5 self-stretch">
                        <Label for="tx_id" value="TxID"  :invalid="form.errors.txid" />
                        <Input
                            v-model="txId"
                            id="tx_id"
                            type="text"
                            class="block w-full"
                            :placeholder="$t('public.txid_placeholder')"
                            :invalid="form.errors.txid"
                        />
                        <InputError :message="form.errors.txid" />
                    </div>
                    <div class="flex items-start gap-3 self-stretch">
                        <div class="text-white">checkbox</div>
                        <div class="text-gray-300 text-xxs">
                            {{ $t('public.deposit_checkbox_desc') }}
                        </div>
                    </div>
                    <Button
                        size="lg"
                        :disabled="is_disabled"
                        class="w-full font-semibold"
                    >
                        {{ $t('public.deposit_now') }}
                    </Button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>

