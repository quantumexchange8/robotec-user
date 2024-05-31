<script setup>
import Button from '@/Components/Button.vue';
import { Lock01Icon } from '@/Components/Icons/outline';
import RobotIllustration from './RobotIllustration.vue';
import Modal from '@/Components/Modal.vue';
import { ref } from 'vue';
import RobotecBanner from './RobotecBanner.vue';

const eaModal = ref(false);
const eaModalVisible = () => {
    eaModal.value = true;
}

const closeEaModal = () => {
    eaModal.value = false
}
</script>

<template>
    <div class="flex pt-5 flex-col items-center gap-10 relative">
        <div class="text-white">progress bar</div>

        <RobotIllustration class="absolute right-0"/>

        <div class="flex py-5 px-4 flex-col items-center gap-10 self-stretch" style="background: linear-gradient(180deg, rgba(24, 34, 48, 0.00) 0%, rgba(24, 34, 48, 0.80) 100%);">
            <div class="flex flex-col items-start gap-5 self-stretch">
                <div class="flex flex-col items-start gap-2 self-stretch">
                    <div class="text-white text-md font-semibold">Step 1: Purchase Robotec</div>
                    <div class="self-stretch text-gray-300 text-xs">
                        Purchase Robotec to receive a unique QR code for inviting friends. Share your code, and start earning commissions with every successful referral!
                    </div>
                </div>

                <Button
                    size="lg"
                    class="font-semibold"
                    @click="eaModalVisible"
                >
                    Purchase Now with $ 250.00
                </Button>
            </div>

            <div class="flex flex-col items-start gap-5 self-stretch">
                <div class="flex flex-col items-start gap-2 self-stretch">
                    <div class="text-white text-md font-semibold">Step 2: Set Up Your Trading Account</div>
                    <div class="self-stretch text-gray-300 text-xs">
                        Create a trading account and fund it to start auto trading and withdraw your earned commissions. Get started now to unlock your trading potential!
                    </div>
                </div>

                <Button
                    size="lg"
                    :disabled="true"
                    class="font-semibold"
                    v-slot="{ iconSizeClasses }"
                >
                    <Lock01Icon class="pr-2"/>
                    Complete Step 1 to Unlock
                </Button>
            </div>
        </div>
    </div>

    <Modal
        :show="eaModal"
        title="Purchase Robotec"
        @close="closeEaModal"
    >
        <div class="py-5 flex flex-col items-center gap-5">
            <div class="flex flex-col items-center gap-5 self-stretch">
                <RobotecBanner />

                <div class="flex flex-col items-center gap-2 self-stretch">
                    <div class="text-white text-center font-semibold">Purchase Robotec for $250.00</div>

                    <div class="self-stretch text-gray-300 text-center text-xs">
                        By purchasing Robotec, $250.00 will be deducted from your cash wallet. Confirm your purchase to proceed and unlock your unique QR code for inviting friends and earning commissions.
                    </div>
                </div>
            </div>

            <div class="flex pt-8 px-1 justify-around items-center gap-3 self-stretch">
                <Button
                    variant="outline"
                    size="lg"
                    type="button"
                    class="w-full font-semibold"
                    @click="closeEaModal"
                >
                    Cancel
                </Button>

                <Button
                    size="lg"
                    type="button"
                    class="w-full font-semibold"
                >
                    Purchase
                </Button>
            </div>
        </div>
    </Modal>
</template>