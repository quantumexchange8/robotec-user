<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import NoData from '@/Components/NoData.vue';
import Button from '@/Components/Button.vue';
import { QrCode01Icon } from '@/Components/Icons/outline';
import { ChevronRightIcon } from '@/Components/Icons/outline';
import { Lock01Icon } from '@/Components/Icons/outline';
import RobotIllustration from './Partials/RobotIllustration.vue';
import Modal from '@/Components/Modal.vue';
import { ref } from 'vue';

const eaModel = ref(false);

const eaModelVisible = () => {
    eaModel.value = true;
}

const closeModal = () => {
    eaModel.value = false
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex py-2 justify-between items-center self-stretch">
                <div class="flex flex-col justify-center items-start">
                    <div class="self-stretch text-white text-xs font-medium">Welcome back👋</div>
                    <div class="self-stretch text-white text-lg font-semibold">Amanda Watson</div>
                </div>
                <div class="flex items-center gap-3">
                    <Button
                        variant="ring-transparent"
                        type="button"
                        :iconOnly="true"
                        v-slot="{ iconSizeClasses }"
                    >
                        <QrCode01Icon />
                    </Button>
                    <div class="w-8 h-8 rounded-full overflow-hidden">
                        <img src="https://pbs.twimg.com/profile_images/1497716648240836608/0T_n2qXz_400x400.jpg" alt="profile_picture">
                    </div>
                </div>
            </div>
        </template>

        <div class="flex mx-4 py-6 px-5 flex-col items-center gap-5 rounded-2xl bg-gray-700">
            <div class="flex justify-between items-center self-stretch">
                <div class="flex flex-col items-start gap-1">
                    <div class="text-gray-300 text-xs font-medium">Cash Wallet ($)</div>
                    <div class="flex items-center gap-5">
                        <div class="text-white text-xl font-semibold">0.00</div>
                        <ChevronRightIcon class="text-gray-600"/>
                    </div>
                </div>

                <Button
                    type="button"
                    href="/deposit"
                    class="text-sm font-semibold"
                >
                    Deposit
                </Button>
            </div>

            <div class="self-stretch border-b border-solid border-gray-600 flex-1"></div>

            <div class="flex items-center gap-7 self-stretch">
                <div class="flex flex-col items-start gap-1 grow">
                    <div class="text-gray-300 text-xs font-medium">Commission ($)</div>
                    <div class="flex items-center gap-5">
                        <div class="text-white text-xl font-semibold">0.00</div>
                        <ChevronRightIcon class="text-gray-600"/>
                    </div>
                </div>

                <div class="self-stretch border-l border-solid border-gray-600 flex-1"></div>

                <div class="flex flex-col items-start gap-1 grow">
                    <div class="text-gray-300 text-xs font-medium">Refree (pax)</div>
                    <div class="flex items-center gap-5">
                        <div class="text-white text-xl font-semibold">0</div>
                        <ChevronRightIcon class="text-gray-600"/>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex pt-5 pb-3 flex-col items-center gap-5 relative">
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
                        @click="eaModelVisible"
                    >
                        Purchase Now with $ 250.00
                    </Button>
                </div>

                <Modal
                    :show="eaModel"
                    @close="closeModal"
                >
                    Purchase Robotec
                </Modal>

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

            <div class="flex px-4 flex-col items-center self-stretch">
                <div class="flex py-2 items-center self-stretch text-white text-xl font-semibold">Overview</div>
                <div class="flex py-2 flex-col items-center gap-3 self-stretch">
                    <div class="flex justify-between items-center self-stretch">
                        <div class="text-gray-300 text-sm font-medium">Today's PAMM Return (%)</div>
                        <div class="text-success-500 text-right text-lg font-semibold">2.19</div>
                    </div>

                    <div class="flex justify-between items-center self-stretch">
                        <div class="text-gray-300 text-sm font-medium">Cumulative PAMM Return (%)</div>
                        <div class="text-white text-right text-lg font-semibold">0</div>
                    </div>

                    <div class="flex justify-between items-center self-stretch">
                        <div class="text-gray-300 text-sm font-medium">Cumulative Earnings ($)</div>
                        <div class="text-white text-right text-lg font-semibold">0</div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
