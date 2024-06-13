<script setup>
import Button from '@/Components/Button.vue';
import { ArrowNarrowUpRightIcon } from '@/Components/Icons/outline';
import { useForm } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const emit = defineEmits([
    'update:productProgressModal',
    'update:button2'
]);

const closeModal = () => {
    emit('update:productProgressModal', false);
}

const bal = ref(300.00);
const fundIn = ref(250.00);
const percentage = computed(() => {
    return (bal.value - fundIn.value) / fundIn.value * 100;
});

const form = useForm({
    amount: ''
});

const submitForm = () => {
    form.amount = bal.value;

    form.post(route('transaction.transfer'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            closeModal();
            emit('update:button2', 'fund_in');
        },
    });
}

</script>

<template>
    <div class="pt-5 flex flex-col items-center gap-5">
        <div class="flex flex-col items-center gap-5 self-stretch">
            <div class="flex py-8 px-5 flex-col justify-center items-center gap-3 self-stretch rounded-2xl bg-gray-800">
                <div class="text-gray-300 text-center font-semibold">{{ $t('public.current_account_balance') }}</div>
                <div class="flex justify-center items-center gap-3">
                    <div class="text-white text-center text-xxl font-semibold">
                        $ {{ bal }}
                    </div>
                    <div class="flex items-center gap-1">
                        <ArrowNarrowUpRightIcon />
                        <div class="text-success-500 text-center text-sm font-medium">
                            {{ percentage }} %
                        </div>
                    </div>
                </div>
            </div>

            <div class="self-stretch text-neutral-400 text-xs">
                {{ $t('public.transfer_desc') }}
            </div>

            <div class="flex pt-8 items-center gap-3 self-stretch">
                <Button
                    variant="outline"
                    size="lg"
                    type="button"
                    class="w-full font-semibold"
                    @click="closeModal"
                >
                    {{ $t('public.cancel') }}
                </Button>

                <Button
                    size="lg"
                    type="button"
                    class="w-full font-semibold"
                    :disabled="form.processing"
                    @click="submitForm"
                >
                    {{ $t('public.transfer_now') }}
                </Button>
            </div>
        </div>
    </div>
</template>