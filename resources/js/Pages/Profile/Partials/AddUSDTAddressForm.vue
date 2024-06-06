<script setup>
import InputError from '@/Components/InputError.vue';
import Label from '@/Components/Label.vue';
import Input from '@/Components/Input.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import Button from '@/Components/Button.vue';

const form = useForm({
    usdt: '',
});

const submitForm = () => {
    console.log('submitting');
    // form.put(route(''), {
    //     preserveScroll: true,
    //     onSuccess: () => form.reset(),
    //     onError: () => {
    //         if (form.errors.usdt) {
    //             form.reset();
    //         }
    //     },
    // });
};
</script>

<template>
    <form 
        @submit.prevent = "submitForm"
        class="pt-5"
    >
        <div class="flex flex-col items-center gap-5">
            <div class="flex flex-col items-start gap-1.5 self-stretch">
                <Label for="usdt" :value="$t('public.usdt_address')" :is_required="false" />
                <Input
                    v-model="form.usdt"
                    id="usdt"
                    type="text"
                    class="block w-full"
                    :placeholder="$t('public.add_usdt_placeholder')"
                />
                <div class="self-stretch text-gray-300 text-xs">
                    {{ $t('public.add_usdt_address_desc') }}
                </div>
                <InputError :message="form.errors.usdt" />
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
                    {{ $t('public.add') }}
                </Button>
            </div>
        </div>
    </form>
</template>