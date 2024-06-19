<script setup>
import {AlertWarningIcon} from '@/Components/Icons/solid';
import Button from '@/Components/Button.vue';
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from '@headlessui/vue'
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    isOpen: Boolean,
});

const emit = defineEmits([
    'update:autoTradeConfirmModal'
]);

const form = useForm({
    confirm: props.isOpen
});

const submitForm = () => {
    form.post(route('trading.start'), {
        preserveScroll: true,
        onSuccess: () => {
            closeModal();
        }
    })
}

const closeModal = () => {
    emit('update:autoTradeConfirmModal', false);
}
</script>

<template>
    <TransitionRoot appear :show="props.isOpen" as="template">
        <Dialog as="div" class="relative z-10" @close="closeModal">
            <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0" enter-to="opacity-100"
                leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 bg-black/25" />
            </TransitionChild>

            <div class="fixed inset-0 overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4 text-center">
                    <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100" leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95">
                        <DialogPanel
                            class="mx-auto w-full max-w-sm transform overflow-hidden rounded-2xl bg-gray-900 py-8 px-4 text-left align-middle shadow-xl transition-all"
                        >
                            <form 
                                @submit.prevent="submitForm"
                                class="flex flex-col items-center gap-8"
                            >
                                <AlertWarningIcon />

                                <div class="flex flex-col items-center gap-1 self-stretch">
                                    <div class="self-stretch text-white text-center text-xs font-semibold">
                                        {{ $t('public.auto_trading_confirmation') }}
                                    </div>
                                    <div class="self-stretch text-neutral-400 text-center text-xs">
                                        {{ $t('public.auto_trading_confirmation_desc') }}
                                    </div>
                                </div>

                                <div class="flex items-center gap-3 self-stretch">
                                    <Button
                                        variant="outline"
                                        type="button"
                                        size="lg"
                                        class="w-full"
                                        @click="closeModal"
                                        :disabled="form.processing"
                                    >
                                        {{ $t('public.cancel') }}
                                    </Button>
                                    <Button
                                        size="lg"
                                        class="w-full"
                                        :disabled="form.processing"
                                    >
                                        {{ $t('public.proceed') }}
                                    </Button>
                                </div>
                            </form>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>