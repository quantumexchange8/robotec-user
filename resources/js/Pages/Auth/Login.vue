<script setup>
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
                        <div class="text-white text-center text-lg font-semibold">
                            {{ $t('public.log_in') }}
                        </div>
                        <div class="self-stretch text-gray-300 text-center text-sm">
                            {{ $t('public.log_in_desc') }}
                        </div>
                    </div>
                </div>

                <div class="flex flex-col items-center gap-3 self-stretch">
                    <div class="flex flex-col items-start gap-1.5 self-stretch">
                        <Label
                            for="email"
                            :invalid="form.errors.email"
                        >
                            {{ $t('public.email') }}
                        </Label>
                        <Input
                            id="email"
                            type="email"
                            class="block w-full"
                            :invalid="form.errors.email"
                            v-model="form.email"
                            autofocus
                            autocomplete="email"
                            :placeholder="$t('public.enter_email')"
                        />
                        <InputError :message="form.errors.email" />
                    </div>

                    <div class="flex flex-col items-start gap-1.5 self-stretch">
                        <Label
                            for="password"
                            :invalid="form.errors.password"
                        >
                            {{ $t('public.password') }}
                        </Label>
                        <Input
                            id="password"
                            v-model="form.password"
                            :is_password="true"
                            :invalid="form.errors.password"
                            :placeholderText="$t('public.enter_password')"
                        />
                        <InputError :message="form.errors.password" />
                    </div>
                </div>

                <div class="flex justify-between items-center self-stretch">
                    <div class="flex items-center gap-2">
                        <Switch name="remember" v-model:checked="form.remember" />
                        <label class="flex items-center">
                            <span class="text-sm text-white">{{ $t('public.remember_me') }}</span>
                        </label>
                    </div>

                    <Button
                        variant="transparent"
                        type="button"
                        :href="route('password.request')"
                        class="text-center font-semibold"
                    >
                        {{ $t('public.forgot_password') }}
                    </Button>
                </div>

                <Button
                    variant="primary"
                    size="lg"
                    class="w-full font-semibold"
                    :disabled="form.processing"
                >
                    {{ $t('public.log_in') }}
                </Button>
            </div>
        </form>
    </GuestLayout>
</template>
