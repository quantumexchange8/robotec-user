<script setup>
import Loader from '@/Pages/Dashboard/Partials/Loader.vue';
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from '@headlessui/vue'

const props = defineProps({
    isOpen: Boolean,
});
</script>

<template>
    <TransitionRoot appear :show="props.isOpen" as="template">
        <Dialog as="div" class="relative z-10">
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
                            <div class="flex flex-col items-center gap-3">
                                <Loader />

                                <div class="flex flex-col items-center gap-1 self-stretch">
                                    <div class="self-stretch text-white text-center text-sm font-semibold">
                                        {{ $t('public.loading') }}
                                    </div>
                                    <div class="self-stretch text-neutral-400 text-center text-xs">
                                        {{ $t('public.creating_account_desc') }}
                                    </div>
                                </div>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>