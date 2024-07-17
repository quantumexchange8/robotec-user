<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import {AlertSuccessIcon} from '@/Components/Icons/solid';
import {ref} from 'vue';
import {transactionFormat} from "@/Composables/index.js";
import Button from '@/Components/Button.vue';
import Tooltip from "@/Components/Tooltip.vue";

const { formatDateTime, formatAmount } = transactionFormat();

const dateTime = ref('2024-07-04 01:44:17');
const amount = ref(250);
const txid = ref('e5e66821b25c5ffecd87e159436510f3c30651ef52bf0a321585b99b11862b7d');

const tooltipContent = ref('copy_link');
const copyCode = (contentId) => {
    const transaction_hash = document.querySelector(contentId).textContent;

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
</script>

<template>
    <Head title="DepositSuccess" />

    <AuthenticatedLayout>
        <div class="py-5 px-4 flex flex-col items-center gap-8">
            <AlertSuccessIcon />

            <div class="flex flex-col items-center gap-1 self-stretch">
                <div class="self-stretch text-white text-center text-sm font-semibold">
                    {{ $t('public.deposit_success') }}
                </div>
                <div class="self-stretch text-neutral-400 text-center text-xs">
                    {{ $t('public.deposit_receive') }}
                </div>
            </div>

            <div class="flex flex-col items-center gap-3 self-stretch">
                <div class="flex justify-between items-center self-stretch">
                    <div class="max-w-[120px] flex-1 text-gray-300 text-sm font-medium">
                        {{ $t('public.date_time') }}
                    </div>
                    <div class="text-white text-center text-sm font-semibold">
                        {{ formatDateTime(dateTime) }}
                    </div>
                </div>

                <div class="flex justify-between items-center self-stretch">
                    <div class="max-w-[120px] flex-1 text-gray-300 text-sm font-medium">
                        {{ $t('public.amount') }}
                    </div>
                    <div class="text-white text-center text-sm font-semibold">
                        $ {{ formatAmount(amount) }}
                    </div>
                </div>

                <div class="flex justify-between items-center self-stretch">
                    <div class="max-w-[120px] flex-1 text-gray-300 text-sm font-medium">
                        TxID
                    </div>
                    <Tooltip :content="$t('public.'+ tooltipContent)" placement="top" class="flex-1">
                        <div id="TxID" class="text-white text-right text-sm font-semibold break-all" @click="copyCode('#TxID')">
                            {{ txid }}
                        </div>
                    </Tooltip>
                </div>
            </div>

            <Button
                variant="primary"
                size="lg"
                :href="route('dashboard')"
                class="w-full font-semibold"
            >
                {{ $t('public.back_to_dashboard') }}
            </Button>
        </div>
    </AuthenticatedLayout>
</template>