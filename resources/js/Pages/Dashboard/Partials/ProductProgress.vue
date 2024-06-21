<script setup>
import Button from '@/Components/Button.vue';
import { Lock01Icon } from '@/Components/Icons/outline';
import RobotIllustration from '@/Pages/Dashboard/Partials/RobotIllustration.vue';
import Modal from '@/Components/Modal.vue';
import { onMounted, onUpdated, ref, watch } from 'vue';
import PurchaseRobotecForm from '@/Pages/Dashboard/Partials/PurchaseRobotecForm.vue';
import InvestmentForm from '@/Pages/Dashboard/Partials/InvestmentForm.vue';
import TransferForm from '@/Pages/Dashboard/Partials/TransferForm.vue';
import ProgressBar from '@/Pages/Dashboard/Partials/ProgressBar.vue';
import { useForm } from '@inertiajs/vue3';
import LoadingDialog from '@/Pages/Dashboard/Partials/LoadingDialog.vue';
import AutoTradingConfirmationModal from '@/Pages/Dashboard/Partials/AutoTradingConfirmationModal.vue';
import {transactionFormat} from "@/Composables/index.js";

const { formatAmount } = transactionFormat();

const props = defineProps({
    robotecTransaction: Boolean,
    walletIds: Object,
    autoTrades: Object,
    tradingAcc: Object,
    autoTradesCount: Number,
});

const productProgressModal = ref(false);
const modalComponent = ref('');
const transferIndex = ref(0);

const openProductProgressModal = (modalType, index = 0) => {
    productProgressModal.value = true;

    if (modalType === 'purchase_robotec') {
        modalComponent.value = modalType;
    } else if (modalType === 'fund_in' || modalType === 'top_up_capital') {
        modalComponent.value = modalType;
    } else if (modalType === 'transfer') {
        modalComponent.value = modalType;
        transferIndex.value = index;
    }
}

const closeModal = () => {
    productProgressModal.value = false;
}

const openLoading = ref(false)

function closeLoadingModal() {
    openLoading.value = false
}

const step1 = ref(props.robotecTransaction);
const progress = ref('0');

watch((step1), (newValue) => {
    if (newValue) {
        progress.value = '1';
    }
}, {immediate: true})

onUpdated(()=>{
    step1.value = props.robotecTransaction;
    updateButton2Status();
})

/*
    status should filter out the condition of the user
    create_account -> when step 1 done (once)
    fund_in -> after create_account done && when no investment (repeatable)
    start_auto_trading -> after fund_in (repeatable)
    top_up_capital -> when got investment (repeatable)
*/
const button2Status = ref('create_account');
const autoTradeModal = ref(false);

const button2 = (status) => {
    switch(status) {
        case 'create_account':
            openLoading.value = true
            submitCreateAccForm();
            break;
        case 'fund_in':
            openProductProgressModal('fund_in');
            break;
        case 'start_auto_trading':
            autoTradeModal.value = true;
            break;
        case 'top_up_capital':
            openProductProgressModal('top_up_capital');
            break;
    }
}

const createAccForm = useForm({
    buttonStatus: '',
});

const submitCreateAccForm = () => {
    createAccForm.post(route('trading.createTradingAccount'), {
        preserveScroll: true,
        onSuccess: () => {
            closeLoadingModal();
            button2Status.value = 'fund_in';
        }
    })
}

const updateButton2Status = () => {
    if (props.tradingAcc) {
        button2Status.value = 'fund_in';

        if (props.tradingAcc.balance > 0) {
            button2Status.value = 'start_auto_trading';
        }
    }

    if (props.autoTrades.length != 0) {
        button2Status.value = 'top_up_capital';
    }

    if (props.autoTradesCount > 0) {
        progress.value = '2';
    }
}

onMounted(() => {
    updateButton2Status();
})
</script>

<template>
    <div class="flex pt-5 flex-col items-center gap-10 relative">
        <div class="relative">
            <ProgressBar :step="progress"/>
        </div>

        <RobotIllustration class="absolute right-2 top-[12%]"/>

        <div class="flex py-5 px-4 flex-col items-center gap-10 self-stretch" style="background: linear-gradient(180deg, rgba(24, 34, 48, 0.00) 0%, rgba(24, 34, 48, 0.80) 100%);">
            <div class="flex flex-col items-start gap-5 self-stretch">
                <div class="flex flex-col items-start gap-2 self-stretch">
                    <div class="text-white text-md font-semibold">
                        {{ $t('public.product_step_1') }}
                    </div>
                    <div class="self-stretch text-gray-300 text-xs">
                        {{ $t('public.product_step_1_desc') }}
                    </div>
                </div>

                <div
                    v-if="step1"
                    class="flex py-3 px-4 justify-center self-stretch rounded-lg text-success-500 text-center text-sm font-semibold"
                    style="background: linear-gradient(180deg, rgba(10, 98, 23, 0.04) 0%, rgba(10, 98, 23, 0.20) 100%);"
                >
                    {{ $t('public.product_step_1_completed') }}
                </div>

                <Button
                    v-else
                    type="button"
                    size="lg"
                    class="font-semibold"
                    @click="openProductProgressModal('purchase_robotec')"
                >
                    {{ $t('public.product_step_1_purchase') }}
                </Button>
            </div>

            <div class="flex flex-col items-start gap-5 self-stretch">
                <div class="flex flex-col items-start gap-2 self-stretch">
                    <div class="text-white text-md font-semibold">
                        {{ $t('public.product_step_2') }}
                    </div>
                    <div class="self-stretch text-gray-300 text-xs">
                        {{ $t('public.product_step_2_desc') }}
                    </div>
                </div>

                <Button
                    v-if="step1"
                    type="button"
                    size="lg"
                    class="font-semibold"
                    @click="button2(button2Status)"
                >
                    {{ $t('public.'+ button2Status) }}
                </Button>

                <Button
                    v-else
                    variant="outline"
                    type="button"
                    size="lg"
                    :disabled="true"
                    class="font-semibold flex gap-2"
                    v-slot="{ iconSizeClasses }"
                >
                    <Lock01Icon />
                    {{ $t('public.complete_step_1_unlock') }}
                </Button>

                <template v-if="props.autoTrades.length != 0">
                    <div
                        v-for="(autoTrade, index) in props.autoTrades"
                        class="flex flex-col items-start gap-2 self-stretch"
                    >
                        <div class="text-xs font-medium">
                            <span class="text-gray-300">
                                {{ $t('public.investment') }} {{ index+1 }}: 
                            </span>
                            <span class="text-success-500">
                                $ {{ formatAmount(autoTrade.investment_amount) }}
                            </span>
                        </div>
                        <Button
                            v-if="autoTrade.matured_at <= 0"
                            variant="gray"
                            type="button"
                            size="lg"
                            class="w-full font-semibold"
                            @click="openProductProgressModal('transfer', index);"
                        >
                            {{ $t('public.transfer') }}
                        </Button>
                        <div
                            v-else
                            class="flex py-3 px-4 justify-center items-center self-stretch rounded-lg bg-gray-900 text-white text-center text-sm font-semibold"
                        >
                            {{ $t('public.matures_in') }} {{ autoTrade.matured_at }} {{ $t('public.days') }}
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <Modal
        :show="productProgressModal"
        :title="$t('public.'+ modalComponent)"
        @close="closeModal"
    >
        <template v-if="modalComponent === 'purchase_robotec'">
            <PurchaseRobotecForm
                @update:productProgressModal="productProgressModal = $event"
            />
        </template>

        <template v-if="modalComponent === 'fund_in' || modalComponent === 'top_up_capital'">
            <InvestmentForm
                :modalType="modalComponent"
                :walletIds="props.walletIds"
                @update:productProgressModal="productProgressModal = $event"
                @update:button2="button2Status = $event"
            />
        </template>

        <template v-if="modalComponent === 'transfer'">
            <TransferForm
                :autoTrades="props.autoTrades"
                :index="transferIndex"
                @update:productProgressModal="productProgressModal = $event"
            />
        </template>
    </Modal>

    <LoadingDialog :isOpen="openLoading" />

    <AutoTradingConfirmationModal
        :isOpen="autoTradeModal"
        @update:button2="button2Status = $event"
        @update:autoTradeConfirmModal="autoTradeModal = $event"
    />
</template>
