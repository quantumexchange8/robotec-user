<script setup>
import Button from '@/Components/Button.vue';
import { Lock01Icon } from '@/Components/Icons/outline';
import RobotIllustration from '@/Pages/Dashboard/Partials/RobotIllustration.vue';
import Modal from '@/Components/Modal.vue';
import { ref, watch } from 'vue';
import PurchaseRobotecForm from '@/Pages/Dashboard/Partials/PurchaseRobotecForm.vue';
import InvestmentForm from '@/Pages/Dashboard/Partials/InvestmentForm.vue';
import TransferForm from '@/Pages/Dashboard/Partials/TransferForm.vue';
import ProgressBar from '@/Pages/Dashboard/Partials/ProgressBar.vue';

const productProgressModal = ref(false);
const modalComponent = ref('');

const openProductProgressModal = (modalType) => {
    productProgressModal.value = true;

    if (modalType === 'purchase_robotec') {
        modalComponent.value = modalType;
    } else if (modalType === 'fund_in' || modalType === 'top_up_capital') {
        modalComponent.value = modalType;
    } else if (modalType === 'transfer') {
        modalComponent.value = modalType;
    }
}

const closeModal = () => {
    productProgressModal.value = false;
}

const step1 = ref(false);
const progress = ref('0');

const purchasingRobotec = () => {
    step1.value = true;
    progress.value = '1';
}

/*
    status should filter out the condition of the user
    create_account -> when step 1 done (once)
    fund_in -> after create_account done && when no investment (repeatable)
    start_auto_trading -> after fund_in (repeatable)
    top_up_capital -> when got investment (repeatable)
*/
const button2Status = ref('create_account');
const investmentStatus = ref(false);

const button2 = (status) => {
    switch(status) {
        case 'create_account':
            console.log('Creating trading account');
            button2Status.value = 'fund_in';
            break;
        case 'fund_in':
            openProductProgressModal('fund_in');
            break;
        case 'start_auto_trading':
            console.log('open start auto trading dialog');
            progress.value = '2';
            button2Status.value = 'top_up_capital'
            investmentStatus.value = true;
            break;
        case 'top_up_capital':
            openProductProgressModal('top_up_capital');
            break;
    }
}

const investmentDuration = ref(90);

const transferring = () => {
    console.log('transferring');
    button2Status.value = 'fund_in';
    investmentStatus.value = false;
}

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

                <div
                    v-if="investmentStatus"
                    class="flex flex-col items-start gap-2 self-stretch"
                >
                    <div class="text-xs font-medium">
                        <span class="text-gray-300">{{ $t('public.investment') }} 1: </span>
                        <span class="text-success-500">$ 250.00</span>
                    </div>

                    <Button
                        v-if="investmentDuration >= 90"
                        variant="gray"
                        type="button"
                        size="lg"
                        :disabled="false"
                        class="w-full font-semibold"
                        @click="openProductProgressModal('transfer');"
                    >
                        {{ $t('public.transfer') }}
                    </Button>

                    <div
                        v-else
                        class="flex py-3 px-4 justify-center items-center self-stretch rounded-lg bg-gray-900 text-white text-center text-sm font-semibold"
                    >
                        {{ $t('public.matures_in') }} {{ 90 - investmentDuration }} {{ $t('public.days') }}
                    </div>
                </div>
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
                @update:button2="purchasingRobotec"
            />
        </template>

        <template v-if="modalComponent === 'fund_in' || modalComponent === 'top_up_capital'">
            <InvestmentForm 
                :modalType="modalComponent"
                @update:productProgressModal="productProgressModal = $event"
                @update:button2="button2Status = $event"
            />
        </template>

        <template v-if="modalComponent === 'transfer'">
            <TransferForm
                @update:productProgressModal="productProgressModal = $event"
                @update:button2="transferring"
            />
        </template>

    </Modal>
</template>
