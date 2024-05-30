<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import Label from '@/Components/Label.vue';
import Button from '@/Components/Button.vue';
import Input from '@/Components/Input.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Switch from '@/Components/Switch.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};

const register = () => {
    window.location.href = '/register'; // Redirect to the login page URL
}

</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div class="flex flex-col justify-center items-center gap-10 px-4">
                <div class="flex flex-col items-center gap-3 self-stretch">
                    <Link href="/">
                        <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
                    </Link>
                    <div class="flex flex-col items-center gap-2 self-stretch">
                        <div class="text-white text-center text-lg font-semibold">Log in</div>
                        <div class="self-stretch text-gray-300 text-center text-sm">Welcome back! Please enter your details.</div>
                    </div>
                </div>

                <div class="flex flex-col items-center gap-3 self-stretch">
                    <div class="flex flex-col items-start gap-1.5 self-stretch">
                        <Label for="email" value="Email" class="text-gray-300" :invalid="form.errors.email" :is_required="false" />
                        <Input
                            id="email"
                            type="email"
                            class="block w-full"
                            :invalid="form.errors.email"
                            v-model="form.email"
                            autofocus
                            autocomplete="email"
                        />
                        <InputError :message="form.errors.email" />
                    </div>

                    <div class="flex flex-col items-start gap-1.5 self-stretch">
                        <Label for="password" value="Password" class="text-gray-300" :invalid="form.errors.password" :is_required="false" />
                        <Input
                            id="password"
                            type="password"
                            class="block w-full"
                            v-model="form.password"
                            :invalid="form.errors.password"
                            autocomplete="password"
                        />
                        <InputError :message="form.errors.password" />
                    </div>
                </div>

                <div class="flex justify-between items-center self-stretch">
                    <div class="flex items-center gap-2">
                        <Switch name="remember" v-model:checked="form.remember" />
                        <label class="flex items-center">
                            <span class="text-sm text-white">Remember me</span>
                        </label>
                    </div>

                    <Button
                        variant="transparent"
                        type="button"
                        :href="route('password.request')"
                        class="text-center font-semibold"
                    >
                        Forgot Password
                    </Button>
                </div>

                <Button 
                    variant="primary"
                    size="lg"
                    class="w-full font-semibold"
                    :disabled="form.processing"
                >
                    Log in
                </Button>
            </div>
        </form>

        <!-- <Button variant="transparent" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="w-full" @click="register">
                Register
        </Button> -->
    </GuestLayout>
</template>
