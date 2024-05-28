<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import Label from '@/Components/Label.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Input from '@/Components/Input.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

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

        <div class="flex flex-col items-center justify-center mb-10">
            <Link href="/">
            <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
            </Link>
            <div class="text-center mt-3">
                <div class="mb-2 text-white text-xl font-semibold">Create Your Account</div>
                <div class="text-gray-300">Welcome! Fill in the details below to join our community. Let's get started!
                </div>
            </div>
        </div>
        <!-- <div class="w-full py-6 relative flex justify-center items-center">
            <div class="absolute left-[30%] top-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10 mb-2">
                <div class="flex flex-col items-center">
                    <div
                        class="w-6 h-6 text-lg text-white flex items-center bg-gray-800 rounded-full border-[3px] border-success-500 justify-center">
                        <div class="w-2 h-2 rounded-full text-lg text-white flex items-center bg-success-500"></div>
                    </div>
                    <div class="text-center text-white text-xs font-medium">Profile Info</div>
                </div>
            </div>

            <div class="absolute left-[30%] top-3 w-40 h-1 bg-gray-800 rounded-[20px]"></div>

            <div class="absolute right-[30%] top-1/2 transform translate-x-1/2 -translate-y-1/2 z-10 mb-2">
                <div class="flex flex-col items-center">
                    <div
                        class="w-6 h-6 text-lg text-white flex items-center rounded-full bg-gray-800 justify-center">
                    </div>
                    <div class="text-center text-white text-xs font-medium">Create Password</div>
                </div>
            </div>
        </div> -->

        <div class="w-full py-6 relative flex justify-center items-center">
            <!-- Left shape -->
            <div class="absolute left-[30%] top-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10 mb-2">
                <div class="flex flex-col items-center">
                    <div
                        class="w-6 h-6 text-lg flex items-center bg-gray-800 rounded-full border-[3px] border-success-500 justify-center">
                        <div class="w-2 h-2 rounded-full text-lg flex items-center bg-success-500"></div>
                    </div>
                    <div class="text-center text-white text-xs font-medium">Profile Info</div>
                </div>
            </div>

            <!-- Progress bar -->
            <div class="absolute left-[30%] top-3 w-40 h-1 rounded-[20px] overflow-hidden">
                <!-- Left half -->
                <div class="absolute left-0 top-0 w-1/2 h-full bg-success-500"></div>
                <!-- Right half -->
                <div class="absolute right-0 top-0 w-1/2 h-full bg-gray-800"></div>
                <!-- Center dot -->
                <div class="absolute z-100 left-[50%] top-[50%] transform -translate-x-1/2 -translate-y-1/2">
                    <div class="w-3 h-3 text-lg flex items-center bg-success-900 rounded-full justify-center">
                        <div class="w-1 h-1 rounded-full text-lg flex items-center bg-success-500"></div>
                    </div>
                </div>
            </div>

            <!-- Right shape -->
            <div class="absolute right-[30%] top-1/2 transform translate-x-1/2 -translate-y-1/2 z-10 mb-2">
                <div class="flex flex-col items-center">
                    <div
                        class="w-6 h-6 text-lg flex items-center rounded-full bg-gray-800 justify-center">
                    </div>
                    <div class="text-center text-white text-xs font-medium">Create Password</div>
                </div>
            </div>
        </div>

        <form @submit.prevent="submit">
            <div>
                <Label for="name" value="Name" class="text-gray-300" :invalid="form.errors.name" />

                <Input id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
                    autocomplete="name" />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <Label for="email" value="Email" class="text-gray-300" :invalid="form.errors.email" />

                <Input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                    autocomplete="username" />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <Label for="password" value="Password" class="text-gray-300" :invalid="form.errors.password" />

                <Input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                    autocomplete="new-password" />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <Label for="password_confirmation" value="Confirm Password" class="text-gray-300"
                    :invalid="form.errors.password_confirmation" />

                <Input id="password_confirmation" type="password" class="mt-1 block w-full"
                    v-model="form.password_confirmation" required autocomplete="new-password" />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link :href="route('login')"
                    class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                Already registered?
                </Link>

                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
