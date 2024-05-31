<script setup>
import { Link } from '@inertiajs/vue3';
import Button from '@/Components/Button.vue';
import { QrCode01Icon } from '@/Components/Icons/outline';
import Modal from '@/Components/Modal.vue';
import Input from '@/Components/Input.vue';
import Qrcode from "qrcode.vue";
import EmptyQrIllustration from './EmptyQrIllustration.vue';
import { ref } from 'vue';

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

</script>

<template>
    <div class="flex items-center gap-3">
        <Button
            variant="outline"
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
                            readonly
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
</template>