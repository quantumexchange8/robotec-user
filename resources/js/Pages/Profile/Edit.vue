<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import { Head, usePage } from '@inertiajs/vue3';
import Button from '@/Components/Button.vue';
import { Upload01Icon, Key01Icon, PlusIcon } from '@/Components/Icons/outline';
import Input from '@/Components/Input.vue';
import Modal from '@/Components/Modal.vue';
import { ref } from 'vue';
import AddUSDTAddressForm from './Partials/AddUSDTAddressForm.vue';

const user = usePage().props.auth.user;
const usdt = '';

const profileModal = ref(false);
const modalComponent = ref('');
const openProfileModal = (modalType) => {
    profileModal.value = true;

    if (modalType === 'change_password') {
        modalComponent.value = modalType;
    } else if (modalType === 'add_usdt_address') {
        modalComponent.value = modalType;
    }
}

const closeModal = () => {
    profileModal.value = false;
}

</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex-1 text-white text-xl">{{ $t('public.my_profile') }}</div>
        </template>

        <div class="flex py-3 px-4 flex-col items-center gap-3">
            <div class="flex py-8 px-4 flex-col items-center gap-8 self-stretch rounded-2xl bg-gray-800">
                <div class="flex flex-col items-center gap-3">
                    <div class="w-14 h-14 rounded-full overflow-hidden">
                        <img 
                            :src="user.profile_photo ? user.profile_photo : 'https://img.freepik.com/free-icon/user_318-159711.jpg'"
                            alt="profile_picture"
                        />
                    </div>
                    <Button
                        type="button"
                        size="lg"
                        class="font-semibold flex gap-2 self-stretch"
                        v-slot="{ iconSizeClasses }"
                    >
                        <Upload01Icon />
                        {{ $t('public.upload_profile_photo') }}
                    </Button>
                    <Button
                        variant="gray"
                        type="button"
                        size="lg"
                        class="font-semibold flex gap-2 self-stretch"
                        v-slot="{ iconSizeClasses }"
                        @click="openProfileModal('change_password')"
                    >
                        <Key01Icon/>
                        {{ $t('public.change_password') }}
                    </Button>
                </div>

                <div class="flex flex-col items-start gap-5 self-stretch">
                    <div class="flex flex-col items-start gap-1 self-stretch">
                        <div class="text-neutral-500 text-sm font-medium">{{ $t('public.name') }}</div>
                        <div class="text-gray-100 font-semibold">{{ user.name }}</div>
                    </div>
                    <div class="flex flex-col items-start gap-1 self-stretch">
                        <div class="text-neutral-500 text-sm font-medium">{{ $t('public.email') }}</div>
                        <div class="text-gray-100 font-semibold">{{ user.email }}</div>
                    </div>
                    <div class="flex flex-col items-start gap-1 self-stretch">
                        <div class="text-neutral-500 text-sm font-medium">{{ $t('public.phone_number') }}</div>
                        <div class="text-gray-100 font-semibold">{{ user.phone }}</div>
                    </div>
                </div>
            </div>

            <div class="flex py-2 items-center self-stretch flex-1 text-white font-semibold">{{ $t('public.usdt_address') }}</div>

            <div v-if="usdt" class="flex flex-col items-start gap-1.5 w-full">
                <Input
                    v-model="usdt"
                    id="usdt_address"
                    type="text"
                    :disabled="true"
                    class="block w-full"
                />
                <div class="self-stretch text-gray-500 text-xs">
                    {{ $t('public.usdt_desc') }}
                </div>
            </div>
            <div v-else class="flex flex-col items-start gap-3 self-stretch">
                <div class="self-stretch text-gray-300 text-xs">
                    {{ $t('public.add_usdt_desc') }}
                </div>
                <Button
                    variant="outline"
                    type="button"
                    class="font-semibold flex gap-2"
                    v-slot="{ iconSizeClasses }"
                    @click="openProfileModal('add_usdt_address')"
                >
                    <PlusIcon />
                    {{ $t('public.add_usdt_address') }}
                </Button>
            </div>

        </div>
    </AuthenticatedLayout>

    <Modal
        :show="profileModal"
        :title="$t('public.'+ modalComponent)"
        @close="closeModal"
    >
        <template v-if="modalComponent === 'change_password'">
            <UpdatePasswordForm @closeModal = "closeModal" />
        </template>

        <template v-if="modalComponent === 'add_usdt_address'">
            <AddUSDTAddressForm @closeModal = "closeModal" />
        </template>
    </Modal>
</template>
