<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';
import Button from '@/Components/Button.vue';
import { Upload01Icon, Key01Icon, PlusIcon } from '@/Components/Icons/outline';
import Input from '@/Components/Input.vue';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const usdt = 'asd';
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex-1 text-white text-xl">My Profile</div>
        </template>

        <div class="flex py-3 px-4 flex-col items-center gap-3">
            <div class="flex py-8 px-4 flex-col items-center gap-8 self-stretch rounded-2xl bg-gray-800">
                <div class="flex flex-col items-center gap-3">
                    <div class="w-14 h-14 rounded-full overflow-hidden">
                        <img src="https://pbs.twimg.com/profile_images/1497716648240836608/0T_n2qXz_400x400.jpg" alt="profile_picture">
                    </div>
                    <Button
                        type="button"
                        size="lg"
                        class="font-semibold flex gap-2 self-stretch"
                        v-slot="{ iconSizeClasses }"
                    >
                        <Upload01Icon />
                        Upload Profile Photo
                    </Button>
                    <Button
                        variant="gray"
                        type="button"
                        size="lg"
                        class="font-semibold flex gap-2 self-stretch"
                        v-slot="{ iconSizeClasses }"
                    >
                        <Key01Icon/>
                        Change Password
                    </Button>
                </div>

                <div class="flex flex-col items-start gap-5 self-stretch">
                    <div class="flex flex-col items-start gap-1 self-stretch">
                        <div class="text-neutral-500 text-sm font-medium">Name</div>
                        <div class="text-gray-100 font-semibold">Amanda Watson</div>
                    </div>
                    <div class="flex flex-col items-start gap-1 self-stretch">
                        <div class="text-neutral-500 text-sm font-medium">Email</div>
                        <div class="text-gray-100 font-semibold">you@example.com</div>
                    </div>
                    <div class="flex flex-col items-start gap-1 self-stretch">
                        <div class="text-neutral-500 text-sm font-medium">Phone Number</div>
                        <div class="text-gray-100 font-semibold">+60 162739223</div>
                    </div>
                </div>
            </div>

            <div class="flex py-2 items-center self-stretch flex-1 text-white font-semibold">USDT Address</div>

            <div v-if="usdt" class="flex flex-col items-start gap-1.5 w-full">
                <Input
                    v-model="usdt"
                    id="usdt_address"
                    type="text"
                    :disabled="true"
                    class="block w-full"
                />
                <div class="self-stretch text-gray-500 text-xs">
                    Note that USDT address cannot be edited. Please contact us for further assistance if needed.
                </div>
            </div>
            <div v-else class="flex flex-col items-start gap-3 self-stretch">
                <div class="self-stretch text-gray-300 text-xs">
                    Enhance your profile by adding your USDT address. This allows you to receive payments and process transactions smoothly.
                </div>
                <Button
                    variant="outline"
                    type="button"
                    class="font-semibold flex gap-2"
                    v-slot="{ iconSizeClasses }"
                >
                    <PlusIcon />
                    Add USDT Address
                </Button>
            </div>

        </div>
    </AuthenticatedLayout>
</template>
