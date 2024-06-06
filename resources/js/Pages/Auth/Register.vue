<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import Label from '@/Components/Label.vue';
import Button from '@/Components/Button.vue';
import Input from '@/Components/Input.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import ProgressBar from '@/Pages/Auth/Partials/ProgressBar.vue'

const form = useForm({
    fullName: '',
    email: '',
    phoneNumber:'',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>

        <Head title="Register" />

        <div class="px-4 pb-10 flex flex-col items-center gap-3 self-stretch">
            <Link href="/">
                <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
            </Link>
            <div class="flex flex-col items-center gap-2 self-stretch">
                <div class="text-white text-center text-lg font-semibold">
                    {{ $t('public.create_your_account') }}
                </div>
                <div class="self-stretch text-gray-300 text-center text-sm">
                    {{ $t('public.register_desc') }}
                </div>
            </div>
        </div>

        <ProgressBar />

        <form 
            @submit.prevent="submit"
            class="px-4 pt-3 flex flex-col items-center gap-10 self-stretch"
        >
            <div class="flex flex-col items-center gap-3 self-stretch">
                <div class="flex flex-col items-start gap-1.5 self-stretch">
                    <Label for="fullName" :value="$t('public.full_name')" :invalid="form.errors.fullName" />
                    <Input
                        v-model="form.fullName"
                        id="fullName"
                        type="text"
                        class="block w-full"
                        :placeholder="$t('public.full_name_placeholder')"
                    />
                    <InputError :message="form.errors.fullName" />
                </div>

                <div class="flex flex-col items-start gap-1.5 self-stretch">
                    <Label for="email" :value="('public.email')" :invalid="form.errors.email" />
                    <Input
                        v-model="form.email"
                        id="email"
                        type="text"
                        class="block w-full"
                        :placeholder="$t('public.enter_email')"
                    />
                    <InputError :message="form.errors.email" />
                </div>

                <div class="flex flex-col items-start gap-1.5 self-stretch">
                    <Label for="phoneNumber" :value="$t('public.phone_number')" :invalid="form.errors.phoneNumber" />
                    <Input
                        v-model="form.phoneNumber"
                        id="phoneNumber"
                        type="text"
                        class="block w-full"
                        :placeholder="$t('public.phone_number')"
                    />
                    <InputError :message="form.errors.phoneNumber" />
                </div>

                <div class="flex flex-col items-start gap-1.5 self-stretch">
                    <Label for="password" :value="$t('public.create_password')" :invalid="form.errors.password" />
                    <Input
                        v-model="form.password"
                        id="password"
                        type="password"
                        class="block w-full"
                        :placeholder="$t('public.new_password')"
                    />
                    <div class="self-stretch text-gray-300 text-xs">
                        {{ $t('public.password_condition') }}
                    </div>
                    <InputError :message="form.errors.password" />
                </div>

                <div class="flex flex-col items-start gap-1.5 self-stretch">
                    <Label for="confirmPassword" :value="$t('public.confirm_password')" :invalid="form.errors.password_confirmation" />
                    <Input
                        v-model="form.password_confirmation"
                        id="confirmPassword"
                        type="text"
                        class="block w-full"
                        :placeholder="$t('public.confirm_password_placeholder')"
                    />
                    <InputError :message="form.errors.password_confirmation" />
                </div>
            </div>

            <div class="flex flex-col justify-center items-center self-stretch">
                <Button
                    size="lg"
                    class="w-full font-semibold"
                >
                    {{ $t('public.next') }}
                </Button>

                <div class="flex py-3 justify-center items-center gap-3 self-stretch">
                    <div class="text-gray-300 text-center text-sm">
                        {{ $t('public.already_have_account') }}
                    </div>
                    <Link
                        :href="route('login')"
                        class="text-white text-center text-sm font-semibold"
                    >
                        {{ $t('public.log_in_here') }}
                    </Link>
                </div>
            </div>
        </form>
    </GuestLayout>
</template>
