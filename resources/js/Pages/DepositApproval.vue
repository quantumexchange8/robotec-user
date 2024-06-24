<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import {Head, Link, useForm} from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Button from "@/Components/Button.vue";
import {transactionFormat} from "@/Composables/index.js";
import Tooltip from "@/Components/Tooltip.vue";
import {Copy01Icon} from "@/Components/Icons/outline.jsx";
import {ref} from "vue";
import Modal from "@/Components/Modal.vue";
import Label from "@/Components/Label.vue";
import InputError from "@/Components/InputError.vue";
import Input from "@/Components/Input.vue";

const props = defineProps({
    transaction: Object,
    user_profile_photo: String,
})
const { formatDateTime, formatAmount } = transactionFormat();

const tooltipContent = ref('copy_link');
const copyCode = () => {
    const transaction_hash = document.querySelector('#txh_hash').textContent;

    const tempInput = document.createElement('input');
    tempInput.value = transaction_hash;
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
        console.error(err)
    }
    document.body.removeChild(tempInput);
}

const form = useForm({
    transaction_id: props.transaction.id,
    status: '',
    remarks: 'Payment Failed'
})

const submit = (transactionStatus) => {
    form.status = transactionStatus
    if (transactionStatus === 'approve') {
        form.remarks = 'System Approved'
    }
    form.post(route('depositRequestApproval'), {
        onSuccess: () => {
            closeModal();
        }
    })
}

const rejectRemarkModal = ref(false)

const openRejectRemarkModal = () => {
    rejectRemarkModal.value = true
}

const closeModal = () => {
    rejectRemarkModal.value = false
}
</script>

<template>
    <GuestLayout>
        <Head :title="$t('public.deposit_approval')" />

        <div class="flex flex-col justify-center items-center gap-5 px-4">
            <div class="flex flex-col items-center gap-3 self-stretch">
                <Link href="/">
                    <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
                </Link>
                <div class="flex flex-col items-center gap-2 self-stretch">
                    <div class="text-white text-center text-lg font-semibold">
                        {{ $t('public.deposit_approval') }}
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-5 items-center p-4 rounded-md w-full">
                <div class="flex flex-col gap-5 items-center self-stretch">
                    <div class="flex gap-2 items-center self-stretch pb-3 border-b border-gray-600">
                        <img
                            class="w-9 h-9 rounded-full overflow-hidden"
                            :src="user_profile_photo ? user_profile_photo : 'https://img.freepik.com/free-icon/user_318-159711.jpg'"
                            alt="profile_picture"
                        />
                        <div class="flex flex-col">
                            <div class="text-white">
                                {{ transaction.user.name }}
                            </div>
                            <div class="text-xs text-gray-400">
                                {{ transaction.user.email }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-2 items-center self-stretch">
                    <div class="flex gap-3 items-center self-stretch">
                        <div class="text-gray-400 text-sm w-[140px]">
                            {{ $t('public.transaction_id')}}
                        </div>
                        <div class="text-white w-full max-w-44">
                            {{ transaction.transaction_number }}
                        </div>
                    </div>
                    <div class="flex gap-3 items-center self-stretch">
                        <div class="text-gray-400 text-sm w-[140px]">
                            {{ $t('public.requested_date')}}
                        </div>
                        <div class="text-white w-full max-w-44">
                            {{ formatDateTime(transaction.created_at) }}
                        </div>
                    </div>
                    <div class="flex gap-3 items-center self-stretch">
                        <div class="text-gray-400 text-sm w-[140px]">
                            {{ $t('public.amount')}}
                        </div>
                        <div class="text-white w-full max-w-44">
                            $ {{ formatAmount(transaction.transaction_amount) }}
                        </div>
                    </div>
                    <div class="flex gap-3 items-center self-stretch">
                        <div class="text-gray-400 text-sm w-[140px]">
                            {{ $t('public.txn_hash')}}
                        </div>
                        <div class="flex items-center gap-1">
                            <div class="text-white w-full max-w-[152px] break-words" id="txh_hash">
                                {{ transaction.txn_hash }}
                            </div>
                            <Tooltip :content="$t('public.'+ tooltipContent)" placement="top">
                                <Copy01Icon class="hover:cursor-pointer" @click="copyCode" />
                            </Tooltip>
                        </div>
                    </div>
                    <div class="flex gap-3 items-center self-stretch">
                        <div class="text-gray-400 text-sm w-[140px]">
                            {{ $t('public.sender_address')}}
                        </div>
                        <div class="text-white w-full max-w-[152px] break-words">
                            {{ transaction.from_wallet_address }}
                        </div>
                    </div>
                    <div class="flex gap-3 items-center self-stretch">
                        <div class="text-gray-400 text-sm w-[140px]">
                            {{ $t('public.receiver_address')}}
                        </div>
                        <div class="text-white w-full max-w-[152px] break-words">
                            {{ transaction.to_wallet_address }}
                        </div>
                    </div>
                </div>
            </div>

            <div v-if="transaction.status === 'processing'" class="flex gap-3 pt-5 items-center self-stretch">
                <Button
                    type="button"
                    variant="danger"
                    class="w-full"
                    @click="openRejectRemarkModal"
                >
                    {{ $t('public.reject') }}
                </Button>
                <Button
                    type="button"
                    variant="success"
                    class="w-full"
                    @click="submit('approve')"
                    :disabled="form.processing"
                >
                    {{ $t('public.approve') }}
                </Button>
            </div>
            <div v-else class="flex gap-3 pt-5 items-center self-stretch">
                <div
                    class="rounded-md flex items-center justify-center text-white px-4 py-2 w-full"
                    :class="{
                        'bg-success-500': transaction.status === 'success',
                        'bg-error-500': transaction.status === 'failed',
                    }"
                >
                    {{ $t('public.' + transaction.status) }}
                </div>
            </div>
        </div>

        <Modal
            :show="rejectRemarkModal"
            :title="$t('public.remarks')"
            @close="closeModal"
        >
            <form class="space-y-2">
                <div class="flex flex-col items-start gap-1.5 self-stretch">
                    <Label for="tx_id" :value="$t('public.remarks')" :invalid="form.errors.remarks" />
                    <Input
                        v-model="form.remarks"
                        id="tx_id"
                        type="text"
                        class="block w-full"
                        autofocus
                        :placeholder="$t('public.remarks')"
                        :invalid="form.errors.remarks"
                    />
                    <InputError :message="form.errors.remarks" />
                </div>

                <div class="flex gap-3 pt-5 items-center self-stretch">
                    <Button
                        type="button"
                        variant="transparent"
                        class="w-full"
                        @click="closeModal"
                    >
                        {{ $t('public.cancel') }}
                    </Button>
                    <Button
                        variant="primary"
                        class="w-full"
                        @click="submit('reject')"
                        :disabled="form.processing"
                    >
                        {{ $t('public.proceed') }}
                    </Button>
                </div>
            </form>
        </Modal>
    </GuestLayout>
</template>
