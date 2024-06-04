<script setup>
import InputError from '@/Components/InputError.vue';
import Label from '@/Components/Label.vue';
import Input from '@/Components/Input.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import Button from '@/Components/Button.vue';

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
            }
            if (form.errors.current_password) {
                form.reset('current_password');
            }
        },
    });
};
</script>

<template>
    <form 
        @submit.prevent = "updatePassword"
        class="pt-5"
    >
        <div class="flex flex-col items-center gap-5 self-stretch">
            <div class="flex flex-col items-start gap-1.5 self-stretch">
                <Label for="currentPassword" value="Current Password"/>
                <Input
                    v-model="form.current_password"
                    id="currentPassword"
                    type="password"
                    class="block w-full"
                    placeholder="Enter current password"
                />
                <InputError :message="form.errors.current_password" />
            </div>

            <div class="flex flex-col items-start gap-1.5 self-stretch">
                <Label for="newPassword" value="New Password"/>
                <Input
                    v-model="form.password"
                    id="newPassword"
                    type="password"
                    class="block w-full"
                    placeholder="Create new password"
                />
                <div class="self-stretch text-gray-300 text-xs  ">
                    Must be at least 8 characters containing one uppercase letter, one lowercase letter, one number, and one special character.
                </div>
                <InputError :message="form.errors.password" />
            </div>

            <div class="flex flex-col items-start gap-1.5 self-stretch">
                <Label for="confrmPassword" value="Confirm Password"/>
                <Input
                    v-model="form.password_confirmation"
                    id="confirmPassword"
                    type="password"
                    class="block w-full"
                    placeholder="Must match with new password"
                />
                <InputError :message="form.errors.password_confirmation" />
            </div>

            <div class="flex pt-8 items-center gap-3 self-stretch">
                <Button
                    variant="outline"
                    size="lg"
                    type="button"
                    class="w-full font-semibold"
                    @click="$emit('closeModal')"
                >
                    Cancel
                </Button>

                <Button
                    size="lg"
                    class="w-full font-semibold"
                    :disabled="form.processing"
                >
                    Save Changes
                </Button>
            </div>
        </div>
    </form>
</template>
