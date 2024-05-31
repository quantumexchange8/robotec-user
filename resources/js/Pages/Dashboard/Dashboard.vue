<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import NoData from '@/Components/NoData.vue';
import Button from '@/Components/Button.vue';
import { QrCode01Icon } from '@/Components/Icons/outline';
import { ChevronRightIcon } from '@/Components/Icons/outline';
import { Lock01Icon } from '@/Components/Icons/outline';
import RobotIllustration from './Partials/RobotIllustration.vue';
import Modal from '@/Components/Modal.vue';
import { ref } from 'vue';
import RobotecBanner from './Partials/RobotecBanner.vue';
import Input from '@/Components/Input.vue';
import Qrcode from "qrcode.vue";
import EmptyQrIllustration from './Partials/EmptyQrIllustration.vue';
import EmptyHistoryIllustration from './Partials/EmptyHistoryIllustration.vue';

const referralCodeModal = ref(false);
const referralCodeModalVisible = () => {
    referralCodeModal.value = true;
}

const closeReferralCodeModal = () => {
    referralCodeModal.value = false
}

const step1 = true;
const referralQr = 'http://thisisalink.test/register/asdasdasd';

const hoverCopy = ref(false);
const copyLink = () => {
    const tempInput = document.createElement('input');
    tempInput.value = referralQr;
    document.body.appendChild(tempInput);
    tempInput.select();
    document.execCommand('copy');
    document.body.removeChild(tempInput);

    setTimeout(function () {
        hoverCopy.value = false;
    }, 3000);
}

const cashWalletModal = ref(false);
const cashWalletModalVisible = () => {
    cashWalletModal.value = true;
}

const closeCashWalletModal = () => {
    cashWalletModal.value = false;
}

const transaction = true;

const comissionWalletModal = ref(false);
const comissionWalletModalVisible = () => {
    comissionWalletModal.value = true;
}

const closeComissionWalletModal = () => {
    comissionWalletModal.value = false;
}

const eaModal = ref(false);
const eaModalVisible = () => {
    eaModal.value = true;
}

const closeEaModal = () => {
    eaModal.value = false
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
                        @click="referralCodeModalVisible"
                    >
                        <QrCode01Icon />
                    </Button>
                    <div class="w-8 h-8 rounded-full overflow-hidden">
                        <Link :href="route('profile.edit')">
                            <img src="https://pbs.twimg.com/profile_images/1497716648240836608/0T_n2qXz_400x400.jpg" alt="profile_picture">
                        </Link>
                    </div>
                </div>
            </div>
        </template>

        <div class="flex mx-4 py-6 px-5 flex-col items-center gap-5 rounded-2xl bg-gray-700">
            <div class="flex justify-between items-center self-stretch">
                <div class="flex flex-col items-start gap-1">
                    <div class="text-gray-300 text-xs font-medium">Cash Wallet ($)</div>
                    <div class="flex items-center gap-5 cursor-pointer" @click="cashWalletModalVisible">
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
                    <div class="flex items-center gap-5 cursor-pointer" @click="comissionWalletModalVisible">
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

        <Modal
            :show="referralCodeModal"
            title="My Referral Code"
            @close="closeReferralCodeModal"
        >
            <div class="py-5">
                <div v-if="step1" class="flex flex-col items-center gap-5 self-stretch">
                    <div class="flex flex-col items-center gap-2 self-stretch">
                        <div class="text-white font-semibold">Scan QR Code</div>
                        <div class="self-stretch text-gray-300 text-center text-xs">
                            Use your unique QR below code to invite friends to join ROBOTEC
                        </div>
                    </div>

                    <Qrcode :value="referralQr" :size="240" render-as="svg" :margin="1" level="M" background="#FFF" />

                    <div class="flex items-center gap-2 self-stretch">
                        <Input
                            v-model="referralQr"
                            type="text"
                            class="block w-full text-xxs"
                            :is_disabled="true"
                        />
                        <div class="relative min-w-fit" @click="hoverCopy = true" @mouseleave="hoverCopy = false">
                            <Button
                                variant="gray"
                                type="button"
                                class="font-semibold self-stretch"
                                @click="copyLink"
                            >
                                Copy Link
                            </Button>

                            <div
                                v-show="hoverCopy"
                                id="copied_success"
                                class="w-32 -left-16 absolute bottom-4 p-1 mb-2 text-sm text-center text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 transition ease-in-out"
                            >
                                Copied!
                            </div>
                        </div>
                    </div>
                </div>

                <div v-else class="flex flex-col items-center gap-5 self-stretch">
                    <EmptyQrIllustration />
                    <div class="flex flex-col items-center gap-2 self-stretch">
                        <div class="text-white text-center font-semibold">Invitation QR Code Not Available</div>
                        <div class="self-stretch text-gray-300 text-center text-sm">
                            You haven't completed Step 1 yet. Purchase Robotec to unlock your unique QR code for inviting friends and earning commissions.
                        </div>
                    </div>
                </div>
            </div>
        </Modal>

        <Modal
            :show="cashWalletModal"
            title="Cash Wallet Transaction"
            @close="closeCashWalletModal"
        >
            <div class="py-5">
                <div v-if="transaction" class="flex flex-col items-start self-stretch">
                    <div class="flex py-2 items-center gap-3 self-stretch">
                        <div class="flex flex-col items-start flex-1">
                            <div class="text-gray-300 text-xs">01/01/2024 09:00:00</div> <!--timestamp-->
                            <div class="max-w-48 self-stretch overflow-hidden text-white text-ellipsis whitespace-nowrap text-sm font-medium">
                                Auto Trading
                            </div>
                        </div>

                        <div class="min-w-fit text-white text-right font-medium">- $ 250.00</div>
                    </div>

                    <div class="flex py-2 items-center gap-3 self-stretch">
                        <div class="flex flex-col items-start flex-1">
                            <div class="text-gray-300 text-xs">01/01/2024 09:00:00</div> <!--timestamp-->
                            <div class="max-w-48 self-stretch overflow-hidden text-white text-ellipsis whitespace-nowrap text-sm font-medium">
                                Deposit
                            </div>
                        </div>

                        <div class="min-w-fit text-success-500 text-right font-medium">+ $ 1,000.00</div>
                    </div>
                </div>

                <div v-else class="flex py-5 flex-col items-center gap-3 self-stretch">
                    <EmptyHistoryIllustration />
                    <div class="self-stretch text-gray-300 text-center text-sm">
                        No transactions found
                    </div>
                </div>
            </div>
        </Modal>

        <Modal
            :show="comissionWalletModal"
            title="Comission Wallet Transaction"
            @close="closeComissionWalletModal"
        >
            <div class="py-5">
                <div v-if="transaction" class="flex flex-col items-start self-stretch">
                    <div class="flex py-2 items-center gap-3 self-stretch">
                        <div class="flex flex-col items-start flex-1">
                            <div class="text-gray-300 text-xs">01/01/2024 09:00:00</div> <!--timestamp-->
                            <div class="max-w-48 self-stretch overflow-hidden text-white text-ellipsis whitespace-nowrap text-sm font-medium">
                                Auto Trading
                            </div>
                        </div>

                        <div class="min-w-fit text-white text-right font-medium">- $ 250.00</div>
                    </div>

                    <div class="flex py-2 items-center gap-3 self-stretch">
                        <div class="flex flex-col items-start flex-1">
                            <div class="text-gray-300 text-xs">01/01/2024 09:00:00</div> <!--timestamp-->
                            <div class="max-w-48 self-stretch overflow-hidden text-white text-ellipsis whitespace-nowrap text-sm font-medium">
                                Comission
                            </div>
                        </div>

                        <div class="min-w-fit text-success-500 text-right font-medium">+ $ 1,000.00</div>
                    </div>
                </div>

                <div v-else class="flex py-5 flex-col items-center gap-3 self-stretch">
                    <EmptyHistoryIllustration />
                    <div class="self-stretch text-gray-300 text-center text-sm">
                        No transactions found
                    </div>
                </div>
            </div>
        </Modal>

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
                        variant="ring-transparent"
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
    </AuthenticatedLayout>
</template>
