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
    name: '',
    email: '',
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
                    Create Your Account
                </div>
                <div class="self-stretch text-gray-300 text-center text-sm">
                    Welcome! Fill in the details below to join our community. Let's get started!
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
                    <Label for="fullName" value="Full Name"/>
                    <Input
                        v-model="fullName"
                        id="fullName"
                        type="text"
                        class="block w-full"
                        placeholder="Name as per NRIC"
                    />
                    <InputError :message="form.errors.fullName" />
                </div>

                <div class="flex flex-col items-start gap-1.5 self-stretch">
                    <Label for="email" value="Email"/>
                    <Input
                        v-model="email"
                        id="email"
                        type="text"
                        class="block w-full"
                        placeholder="Enter Email"
                    />
                    <InputError :message="form.errors.email" />
                </div>

                <div class="flex flex-col items-start gap-1.5 self-stretch">
                    <Label for="phoneNumber" value="Phone Number"/>
                    <Input
                        v-model="phoneNumber"
                        id="phoneNumber"
                        type="text"
                        class="block w-full"
                        placeholder="Phone Number"
                    />
                    <InputError :message="form.errors.phoneNumber" />
                </div>

                <div class="flex flex-col items-start gap-1.5 self-stretch">
                    <Label for="password" value="Create Password"/>
                    <Input
                        v-model="password"
                        id="password"
                        type="password"
                        class="block w-full"
                        placeholder="New password"
                    />
                    <div class="self-stretch text-gray-300 text-xs">
                        Must be at least 8 characters containing one uppercase letter, one lowercase letter, one number, and one special character.
                    </div>
                    <InputError :message="form.errors.password" />
                </div>

                <div class="flex flex-col items-start gap-1.5 self-stretch">
                    <Label for="confirmPassword" value="Confirm Password"/>
                    <Input
                        v-model="password_confirmation"
                        id="confirmPassword"
                        type="text"
                        class="block w-full"
                        placeholder="Must match with new password"
                    />
                    <InputError :message="form.errors.password_confirmation" />
                </div>
            </div>

            <div class="flex flex-col justify-center items-center self-stretch">
                <Button
                    size="lg"
                    class="w-full font-semibold"
                >
                    Next
                </Button>

                <div class="flex py-3 justify-center items-center gap-3 self-stretch">
                    <div class="text-gray-300 text-center text-sm">
                        Already have an account?
                    </div>
                    <Link
                        :href="route('login')"
                        class="text-white text-center text-sm font-semibold"
                    >
                        Log in here
                    </Link>
                </div>
            </div>
        </form>
    </GuestLayout>
</template>
