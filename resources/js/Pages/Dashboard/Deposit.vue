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
import Checkbox from '@/Components/Checkbox.vue';
import { computed, onMounted, ref, watch } from "vue";
import Tooltip from "@/Components/Tooltip.vue";

const props = defineProps({
    'wallet_addresses': Array,
});

const is_disabled = ref(true);
const amount = ref('');
const txid = ref('');

const walletAddressesSelect = props.wallet_addresses;
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
const tooltipContent = ref('copy_link');
const copyCode = () => {
    const walletCode = document.querySelector('#WalletCode').textContent;

    const tempInput = document.createElement('input');
    tempInput.value = walletCode;
    document.body.appendChild(tempInput);
    tempInput.select();

    try {
        var successful = document.execCommand('copy');
        if (successful) {
            tooltipContent.value = 'copied';
            setTimeout(() => {
                tooltipContent.value = 'copy_link';
            }, 3000);
        } else {
            tooltipContent.value = 'try_again_later';
        }
    } catch (err) {
        alert($t('public.copy_error'))
    }
    document.body.removeChild(tempInput);

}

const form = useForm({
    amount: '',
    txid: '',
    terms: false,
    to_wallet_address: '',
});

const submitForm = () => {
    form.amount = amount.value;
    form.txid = txid.value;
    form.to_wallet_address = qrAddress.value;

    form.post(route('transaction.deposit.store'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        },
        onError: () => {
            if (form.errors.amount) {
                form.reset('amount');
            }
            if (form.errors.txid) {
                form.reset('txid');
            }
        }
    })
}

const buttonStatus = () => {
    is_disabled.value = !(amount.value && txid.value);
}

watch(amount, () => {
    buttonStatus();
});

watch(txid, () => {
    buttonStatus();
});
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
                            <Qrcode :value="qrAddress" :size="160" render-as="svg" :margin="1" level="M" background="#FFF" />
                        </div>
                        <div class="flex justify-center items-center gap-2 self-stretch flex-wrap">
                            <div class="text-gray-300 text-xxs" id="WalletCode">
                                {{ qrAddress }}
                            </div>
                            <Tooltip :content="$t('public.'+ tooltipContent)" placement="top">
                                <Copy01Icon class="hover:cursor-pointer" @click="copyCode" />
                            </Tooltip>
                        </div>
                    </div>
                    <div class="flex flex-col items-start gap-1.5 self-stretch">
                        <Label for="deposit_amount" :value="$t('public.deposit_amount')" :invalid="form.errors.amount" />
                        <Input
                            v-model="amount"
                            id="deposit_amount"
                            type="text"
                            class="block w-full"
                            placeholder="$ 0.00"
                            :invalid="form.errors.amount"
                        />
                        <InputError :message="form.errors.amount" />
                    </div>
                    <div class="flex flex-col items-start gap-1.5 self-stretch">
                        <Label for="tx_id" value="TxID" :invalid="form.errors.txid" />
                        <Input
                            v-model="txid"
                            id="tx_id"
                            type="text"
                            class="block w-full"
                            :placeholder="$t('public.txid_placeholder')"
                            :invalid="form.errors.txid"
                        />
                        <InputError :message="form.errors.txid" />
                    </div>
                    <div class="flex flex-col items-start gap-1.5 self-stretch">
                        <div class="flex gap-3 items-start self-stretch">
                            <Checkbox id="terms" v-model="form.terms"/>
                            <Label for="terms" class="text-xxs" :invalid="form.errors.terms">
                                {{ $t('public.deposit_checkbox_desc') }}
                            </Label>
                        </div>
                        <InputError :message="form.errors.terms" />
                    </div>

                    <Button
                        size="lg"
                        :disabled="is_disabled || form.processing || !form.terms"
                        class="w-full font-semibold"
                    >
                        {{ $t('public.deposit_now') }}
                    </Button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>

