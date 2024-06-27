<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import Button from '@/Components/Button.vue';
import { QrCode01Icon } from '@/Components/Icons/outline';
import Modal from '@/Components/Modal.vue';
import Input from '@/Components/Input.vue';
import Qrcode from "qrcode.vue";
import EmptyQrIllustration from './EmptyQrIllustration.vue';
import { onUpdated, ref } from 'vue';
import Tooltip from '@/Components/Tooltip.vue';
import DefaultProfilePhoto from '@/Components/DefaultProfilePhoto.vue';

const user = ref(usePage().props.auth.user);
const props = defineProps({
    user: Object,
    robotecTransaction: Boolean,
});

const referralCodeModal = ref(false);
const openReferralCodeModal = () => {
    referralCodeModal.value = true;
}

const closeReferralCodeModal = () => {
    referralCodeModal.value = false
}

const step1 = ref(props.robotecTransaction);
const referralQr = route('register', props.user.referral_code);
const tooltipContent = ref('copy_link');

const copyLink = () => {
    const tempInput = document.createElement('input');
    tempInput.value = referralQr;
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

onUpdated(()=>{
    step1.value = props.robotecTransaction;
    user.value = usePage().props.auth.user;
})
</script>

<template>
    <div class="flex items-center gap-3">
        <Button
            variant="outline"
            type="button"
            :iconOnly="true"
            v-slot="{ iconSizeClasses }"
            @click="openReferralCodeModal"
        >
            <QrCode01Icon />
        </Button>
        <div class="w-8 h-8 rounded-full overflow-hidden">
            <Link :href="route('profile.edit')">
                <template v-if="user.profile_photo">
                    <img :src="user.profile_photo" alt="profile_picture" />
                </template>
                <template v-else>
                    <DefaultProfilePhoto />
                </template>
            </Link>
        </div>
    </div>

    <Modal
        :show="referralCodeModal"
        :title="$t('public.my_referral_code')"
        @close="closeReferralCodeModal"
    >
        <div class="py-5">
            <div 
                v-if="step1" 
                class="flex flex-col items-center gap-5 self-stretch"
            >
                <div class="flex flex-col items-center gap-2 self-stretch">
                    <div class="text-white font-semibold">{{ $t('public.scan_qr_code') }}</div>
                    <div class="self-stretch text-gray-300 text-center text-xs">
                        {{ $t('public.scan_qr_desc') }}
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
                    <div class="relative min-w-fit">
                        <Tooltip :content="$t('public.'+ tooltipContent)" placement="top">
                            <Button
                                variant="gray"
                                type="button"
                                class="font-semibold self-stretch"
                                @click="copyLink"
                            >
                                {{ $t('public.copy_link') }}
                            </Button>
                        </Tooltip>
                    </div>
                </div>
            </div>

            <div 
                v-else 
                class="flex flex-col items-center gap-5 self-stretch"
            >
                <EmptyQrIllustration />
                <div class="flex flex-col items-center gap-2 self-stretch">
                    <div class="text-white text-center font-semibold">{{ $t('public.referral_qr_not_available') }}</div>
                    <div class="self-stretch text-gray-300 text-center text-sm">
                        {{ $t('public.referral_qr_not_available_desc') }}
                    </div>
                </div>
            </div>
        </div>
    </Modal>
</template>