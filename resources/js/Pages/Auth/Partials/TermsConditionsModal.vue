<script setup>
import Button from '@/Components/Button.vue';
import {Dialog, DialogPanel, TransitionChild, TransitionRoot,} from '@headlessui/vue'
import {onMounted, ref, watch} from "vue";

const props = defineProps({
    isOpen: Boolean,
    term: Object,
});

const emit = defineEmits([
    'update:termsConditionsModal',
    'confirmation:agreement'
]);

const agree = () => {
    emit('update:termsConditionsModal', false);
    emit('confirmation:agreement', true);
}

const closeModal = () => {
    emit('update:termsConditionsModal', false);
    emit('confirmation:agreement', false);
}

const scrollContainer = ref(null);
const scrolledToBottom = ref(false);

const handleScroll = () => {
    const container = scrollContainer.value;
    if (container) {
        scrolledToBottom.value = container.scrollHeight - container.scrollTop === container.clientHeight;
    }
};

onMounted(() => {
    // Check initially if the content is already scrolled to the bottom
    handleScroll();
});

watch(() => props.term.contents, () => {
    // Reset the scroll position and state when contents change
    if (scrollContainer.value) {
        scrollContainer.value.scrollTop = 0;
    }
    scrolledToBottom.value = false;
});
</script>

<template>
    <TransitionRoot appear :show="props.isOpen" as="template">
        <Dialog as="div" class="relative z-10" @close="closeModal()">
            <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0" enter-to="opacity-100"
                leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 bg-black/25" />
            </TransitionChild>

            <div class="fixed inset-0">
                <div class="flex min-h-full items-center justify-center p-4 text-center">
                    <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100" leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95">
                        <DialogPanel
                            class="max-h-[540px] mx-auto w-full max-w-sm transform overflow-y-auto rounded-2xl bg-gray-900 py-8 px-4 text-left align-middle shadow-xl transition-all"
                        >
                            <div class="pb-1 self-stretch text-white text-sm font-semibold">
                                {{ $t('public.terms_and_conditions') }}
                            </div>
                            <div
                                class="overflow-y-auto max-h-72"
                                ref="scrollContainer"
                                @scroll="handleScroll"
                            >
                                <div class="text-white text-xxs" v-html="term.contents"></div>
                            </div>
                            <div class="pt-8 flex flex-col justify-center items-center gap-3 self-stretch">
                                <div class="self-stretch text-gray-300 text-xxs">
                                    {{ $t('public.login_agreement_desc') }}
                                </div>

                                <div class="flex justify-center items-center gap-3 self-stretch">
                                    <Button
                                        variant="outline"
                                        type="button"
                                        size="lg"
                                        class="w-full font-semibold"
                                        @click="closeModal()"
                                    >
                                        {{ $t('public.disagree') }}
                                    </Button>
                                    <Button
                                        type="button"
                                        size="lg"
                                        class="w-full font-semibold"
                                        @click="agree()"
                                        :disabled="!scrolledToBottom"
                                    >
                                        {{ $t('public.agree') }}
                                    </Button>
                                </div>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>
