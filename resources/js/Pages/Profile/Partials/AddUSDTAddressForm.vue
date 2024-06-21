<script setup>
import InputError from '@/Components/InputError.vue';
import Label from '@/Components/Label.vue';
import Input from '@/Components/Input.vue';
import { useForm } from '@inertiajs/vue3';
import Button from '@/Components/Button.vue';

const emit = defineEmits(['update:modal']);

const form = useForm({
    usdt: '',
});

const submitForm = () => {
    form.post(route('profile.usdt'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            closeModal();
        },
    });
};

const closeModal = () => {
    emit('update:modal', false);
}
</script>

<template>
    <form 
        @submit.prevent = "submitForm"
        class="pt-5"
    >
        <div class="flex flex-col items-center gap-5">
            <div class="flex flex-col items-start gap-1.5 self-stretch">
                <Label for="usdt" :invalid="form.errors.usdt">
                    {{ $t('public.usdt_address') }}
                </Label>
                <Input
                    v-model="form.usdt"
                    id="usdt"
                    type="text"
                    class="block w-full"
                    :placeholder="$t('public.add_usdt_placeholder')"
                    :invalid="form.errors.usdt"
                />
                <InputError :message="form.errors.usdt" />
                <div class="self-stretch text-gray-300 text-xs">
                    {{ $t('public.add_usdt_address_desc') }}
                </div>
            </div>

            <div class="flex pt-8 items-center gap-3 self-stretch">
                <Button
                    variant="outline"
                    size="lg"
                    type="button"
                    class="w-full font-semibold"
                    :disabled="form.processing"
                    @click="closeModal"
                >
                    {{ $t('public.cancel') }}
                </Button>

                <Button
                    size="lg"
                    class="w-full font-semibold"
                    :disabled="form.processing"
                >
                    {{ $t('public.add') }}
                </Button>
            </div>
        </div>
    </form>
</template>