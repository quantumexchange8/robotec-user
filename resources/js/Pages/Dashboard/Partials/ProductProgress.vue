<script setup>
import Button from '@/Components/Button.vue';
import { Lock01Icon } from '@/Components/Icons/outline';
import RobotIllustration from '@/Pages/Dashboard/Partials/RobotIllustration.vue';
import Modal from '@/Components/Modal.vue';
import { ref, watch } from 'vue';
import PurchaseRobotecForm from '@/Pages/Dashboard/Partials/PurchaseRobotecForm.vue';
import InvestmentForm from '@/Pages/Dashboard/Partials/InvestmentForm.vue';
import TransferForm from '@/Pages/Dashboard/Partials/TransferForm.vue';

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

const button2 = () => {
    // openProductProgressModal('fund_in');
    // openProductProgressModal('top_up_capital');
    openProductProgressModal('transfer');
}

// step1 success button
const step1 = ref(true);
const button1Variant = ref('primary');
const button1Class = ref('font-semibold')
const button1Content = ref('Purchase Now with $ 250.00');

const button2Variant = ref('outline');
const button2Disabled = ref(true);
const button2Content = ref('Complete Step 1 to Unlock');

watch(step1, (newValue) => {
    if(newValue) {
        // button1Variant.value = 'success';
        // button1Class.value = 'w-full text-success-500 font-semibold';
        // button1Content.value = 'Well Done! Step 1 is completed. 🌟';

        button2Variant.value = 'primary';
        button2Disabled.value = false;
        button2Content.value = 'Create Trading Account'
    }
},
{immediate:true});

// create account
/* 
    status should filter out the condition of the user
    create_account -> when step 1 done (once)
    fund_in -> after create_account done && when no investment (repeatable)
    start_auto_trading -> after first fund_in (repeatable)
    top_up -> when got investment (repeatable)
*/
// const button2Status = ref('create_account');
// const button2 = (status) => {
//     switch(status) {
//         case 'create_account':
//             console.log('Creating trading account');
//             button2Status.value = 'fund_in';
//             break;
//         case 'fund_in':
//             console.log('open fund in modal');
//             break;
//         case 'start_auto_trading':
//             console.log('open start auto trading dialog');
//             break;
//         case 'top_up':
//             console.log('open top up capital modal');
//             break;
//     }
// }

// watch(button2Status, (newValue) => {
//     switch(newValue) {
//         case 'fund_in':
//             button2Content.value = 'Fund In'
//             break;
//         case 'start_auto_trading':
//             button2Content.value = 'Start Robotec Auto Trading'
//             break;
//         case 'top_up':
//             button2Content.value = 'Top Up Capital'
//             break;
//     }
// })

</script>

<template>
    <div class="flex pt-5 flex-col items-center gap-10 relative">
        <div class="text-white">progress bar</div>

        <RobotIllustration class="absolute right-0"/>

        <div class="flex py-5 px-4 flex-col items-center gap-10 self-stretch" style="background: linear-gradient(180deg, rgba(24, 34, 48, 0.00) 0%, rgba(24, 34, 48, 0.80) 100%);">
            <div class="flex flex-col items-start gap-5 self-stretch">
                <div class="flex flex-col items-start gap-2 self-stretch">
                    <div class="text-white text-md font-semibold">
                        Step 1: Purchase Robotec
                    </div>
                    <div class="self-stretch text-gray-300 text-xs">
                        Purchase Robotec to receive a unique QR code for inviting friends. Share your code, and start earning commissions with every successful referral!
                    </div>
                </div>

                <Button
                    :variant="button1Variant"
                    type="button"
                    size="lg"
                    :class="button1Class"
                    @click="openProductProgressModal('purchase_robotec')"
                >
                    {{ button1Content }}
                </Button>
            </div>

            <div class="flex flex-col items-start gap-5 self-stretch">
                <div class="flex flex-col items-start gap-2 self-stretch">
                    <div class="text-white text-md font-semibold">
                        Step 2: Set Up Your Trading Account
                    </div>
                    <div class="self-stretch text-gray-300 text-xs">
                        Create a trading account and fund it to start auto trading and withdraw your earned commissions. Get started now to unlock your trading potential!
                    </div>
                </div>

                <Button
                    :variant="button2Variant"
                    type="button"
                    size="lg"
                    :disabled="button2Disabled"
                    class="font-semibold"
                    v-slot="{ iconSizeClasses }"
                    @click="button2()"
                >
                    <Lock01Icon v-if="!step1" class="pr-2 text-success-500"/> 
                    {{ button2Content }}
                </Button>

                <div 
                    v-if="true"
                    class="flex flex-col items-start gap-2 self-stretch"
                >
                    <div class="text-xs font-medium">
                        <span class="text-gray-300">1st investment: </span>
                        <span class="text-success-500">$ 250.00</span>
                    </div>
<!-- button bot gray -->
                    <Button
                        variant="gray"
                        type="button"
                        size="lg"
                        :disabled="true"
                        class="w-full font-semibold"
                    >
                        Matures in 90 days
                    </Button>
                </div>
            </div>
        </div>
    </div>

    <Modal
        :show="productProgressModal"
        :title="modalComponent"
        @close="closeModal"
    >
        <template v-if="modalComponent === 'purchase_robotec'">
            <PurchaseRobotecForm @closeModal = "closeModal"/>
        </template>
        
        <template v-if="modalComponent === 'fund_in' || modalComponent === 'top_up_capital'">
            <InvestmentForm :modalType="modalComponent" @closeModal = "closeModal"/>
        </template>
        
        <template v-if="modalComponent === 'transfer'">
            <TransferForm @closeModal = "closeModal"/>
        </template>
        
    </Modal>
</template>