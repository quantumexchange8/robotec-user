<script setup>
import InputError from '@/Components/InputError.vue';
import Label from '@/Components/Label.vue';
import Input from '@/Components/Input.vue';
import { useForm } from '@inertiajs/vue3';
import Button from '@/Components/Button.vue';

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            emit('update:modal', false);
        },
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
                <Label for="currentPassword" :value="$t('public.current_password')" :invalid="form.errors.current_password" />
                <Input
                    v-model="form.current_password"
                    id="currentPassword"
                    :is_password="true"
                    :placeholderText="$t('public.enter_current_password')"
                    :invalid="form.errors.current_password"
                />
                <InputError :message="form.errors.current_password" />
            </div>

            <div class="flex flex-col items-start gap-1.5 self-stretch">
                <Label for="newPassword" :value="$t('public.new_password')" :invalid="form.errors.password" />
                <Input
                    v-model="form.password"
                    id="newPassword"
                    :is_password="true"
                    :placeholderText="$t('public.create_new_password')"
                    :invalid="form.errors.password"
                />
                <InputError :message="form.errors.password" />
                <div class="self-stretch text-gray-300 text-xs  ">
                    {{ $t('public.password_condition') }}
                </div>
            </div>

            <div class="flex flex-col items-start gap-1.5 self-stretch">
                <Label for="confrmPassword" :value="$t('public.confirm_password')" :invalid="form.errors.password_confirmation" />
                <Input
                    v-model="form.password_confirmation"
                    id="confirmPassword"
                    :is_password="true"
                    :placeholderText="$t('public.confirm_password_placeholder')"
                    :invalid="form.errors.password_confirmation"
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
                    {{ $t('public.cancel') }}
                </Button>

                <Button
                    size="lg"
                    class="w-full font-semibold"
                    :disabled="form.processing"
                >
                    {{ $t('public.save_changes') }}
                </Button>
            </div>
        </div>
    </form>
</template>
