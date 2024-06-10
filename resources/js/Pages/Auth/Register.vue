<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import Label from '@/Components/Label.vue';
import Button from '@/Components/Button.vue';
import Input from '@/Components/Input.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import ProgressBar from '@/Pages/Auth/Partials/ProgressBar.vue'
import { ref, watch } from 'vue';
import { ArrowNarrowLeftIcon } from '@/Components/Icons/outline';

// 0, 1
const step = ref('0');

const form = useForm({
    fullName: '',
    email: '',
    phoneNumber:'',
    password: '',
    password_confirmation: '',
    formStep: 0,
});

const firstStep = () => {
    // console.log(form.fullName);
    // console.log(form.email);
    // console.log(form.phoneNumber);
    // form.post(route('register.firstStep'), {
        // onSuccess: () => {
            step.value = '1';
            form.formStep++;
        // },
    // });
}

const backToFirstStep = () => {
    step.value = '0';
    form.formStep--;
}
watch(step, (v) => {
    console.log('new: '+ v);
})
const submitForm = () => {
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

        <ProgressBar :step="step" />

        <form 
            @submit.prevent="submitForm"
            class="px-4 pt-3 flex flex-col items-center gap-10 self-stretch"
        >
<!-- page 1 (step 0) -->
            <div class="flex flex-col items-center gap-3 self-stretch">
                <div 
                    v-show="step === '0'"
                    class="flex flex-col items-start gap-1.5 self-stretch"
                >
                    <Label for="fullName" :value="$t('public.full_name')" :invalid="form.errors.fullName" />
                    <Input
                        v-model="form.fullName"
                        id="fullName"
                        type="text"
                        class="block w-full"
                        :invalid="form.errors.fullName"
                        :placeholder="$t('public.full_name_placeholder')"
                    />
                    <InputError :message="form.errors.fullName" />
                </div>

                <div 
                    v-show="step === '0'"
                    class="flex flex-col items-start gap-1.5 self-stretch"
                >
                    <Label for="email" :value="$t('public.email')" :invalid="form.errors.email" />
                    <Input
                        v-model="form.email"
                        id="email"
                        type="text"
                        class="block w-full"
                        :invalid="form.errors.email"
                        :placeholder="$t('public.enter_email')"
                    />
                    <InputError :message="form.errors.email" />
                </div>

                <div 
                    v-show="step === '0'"
                    class="flex flex-col items-start gap-1.5 self-stretch"
                >
                    <Label for="phoneNumber" :value="$t('public.phone_number')" :invalid="form.errors.phoneNumber" />
                    <Input
                        v-model="form.phoneNumber"
                        id="phoneNumber"
                        type="text"
                        class="block w-full"
                        :invalid="form.errors.phoneNumber"
                        :placeholder="$t('public.phone_number')"
                    />
                    <InputError :message="form.errors.phoneNumber" />
                </div>
<!-- page 2 (step 1) -->
                <div 
                    v-show="step === '1'"
                    class="flex flex-col items-start gap-1.5 self-stretch"
                >
                    <Label for="password" :value="$t('public.create_password')" :invalid="form.errors.password" />
                    <Input
                        v-model="form.password"
                        id="password"
                        :is_password="true"
                        :invalid="form.errors.password"
                        :placeholderText="$t('public.new_password')"
                    />
                    <InputError :message="form.errors.password" />
                    <div class="self-stretch text-gray-300 text-xs">
                        {{ $t('public.password_condition') }}
                    </div>
                </div>

                <div 
                    v-show="step === '1'"
                    class="flex flex-col items-start gap-1.5 self-stretch"
                >
                    <Label for="confirmPassword" :value="$t('public.confirm_password')" :invalid="form.errors.password_confirmation" />
                    <Input
                        v-model="form.password_confirmation"
                        id="confirmPassword"
                        :is_password="true"
                        :invalid="form.errors.password_confirmation"
                        :placeholderText="$t('public.confirm_password_placeholder')"
                    />
                    <InputError :message="form.errors.password_confirmation" />
                </div>
            </div>
<!-- based on step(0 / 1), display next block/ register block -->
            <div class="flex flex-col justify-center items-center gap-3 self-stretch">
                <template v-if="step === '0'">
                    <Button
                        size="lg"
                        type="button"
                        class="w-full font-semibold"
                        @click="firstStep"
                    >
                        {{ $t('public.next') }}
                    </Button>
                    <div class="flex justify-center items-center gap-3 self-stretch">
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
                </template>

                <template v-else>
                    <div class="self-stretch text-gray-300 text-xxs">
                        {{ $t('public.register_agree_desc') }}
                    </div>
                    <Button
                        size="lg"
                        class="w-full font-semibold"
                    >
                        {{ $t('public.register') }}
                    </Button>
                    <Button
                        variant="transparent"
                        type="button"
                        size="lg"
                        class="w-full font-semibold flex gap-2"
                        v-slot="{ iconSizeClasses }"
                        @click="backToFirstStep"
                    >
                        <ArrowNarrowLeftIcon />
                        {{ $t('public.go_back') }}
                    </Button>
                </template>
            </div>
        </form>
    </GuestLayout>
</template>
