<script setup>
import { computed, onMounted, onUnmounted, watch } from 'vue';
import {XIcon} from "@/Components/Icons/outline.jsx";
import Button from "@/Components/Button.vue";

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: '2xl',
    },
    closeable: {
        type: Boolean,
        default: true,
    },
    title: String
});

const emit = defineEmits(['close']);

watch(
    () => props.show,
    () => {
        if (props.show) {
            document.body.style.overflow = 'hidden';
        } else {
            document.body.style.overflow = null;
        }
    }
);

const close = () => {
    if (props.closeable) {
        emit('close');
    }
};

const closeOnEscape = (e) => {
    if (e.key === 'Escape' && props.show) {
        close();
    }
};

onMounted(() => document.addEventListener('keydown', closeOnEscape));

onUnmounted(() => {
    document.removeEventListener('keydown', closeOnEscape);
    document.body.style.overflow = null;
});

const maxWidthClass = computed(() => {
    return {
        sm: 'sm:max-w-sm',
        md: 'sm:max-w-md',
        lg: 'sm:max-w-lg',
        xl: 'sm:max-w-xl',
        '2xl': 'max-w-[360px]',
    }[props.maxWidth];
});
</script>

<template>
    <Teleport to="body">
        <Transition leave-active-class="duration-200">
            <div
                v-show="show"
                class="fixed inset-0 z-50"
                scroll-region
            >
                <div class="flex items-center min-h-[calc(100vh-5rem)] justify-center p-4">
                    <Transition
                        enter-active-class="ease-out duration-300"
                        enter-from-class="opacity-0"
                        enter-to-class="opacity-100"
                        leave-active-class="ease-in duration-200"
                        leave-from-class="opacity-100"
                        leave-to-class="opacity-0"
                    >
                        <div v-show="show" class="fixed inset-0 transform transition-all" @click="close">
                            <div class="absolute inset-0 bg-gray-800 opacity-75" />
                        </div>
                    </Transition>

                    <Transition
                        enter-active-class="ease-out duration-300"
                        enter-from-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        enter-to-class="opacity-100 translate-y-0 sm:scale-100"
                        leave-active-class="ease-in duration-200"
                        leave-from-class="opacity-100 translate-y-0 sm:scale-100"
                        leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    >
                        <div
                            v-if="show"
                            class="p-4 bg-gray-900 max-h-[calc(100vh-2rem)] rounded-lg overflow-hidden shadow-xl transform transition-all w-full mx-auto"
                            :class="maxWidthClass"
                        >
                            <div class="flex justify-between items-center pb-3">
                                <div class="text-white font-semibold">
                                    {{ title }}
                                </div>
                                <XIcon
                                    class="text-gray-400 hover:text-white hover:cursor-pointer"
                                    @click="close"
                                />
                            </div>
                            <div class="overflow-y-auto max-h-[calc(100vh-8rem)]">
                                <slot v-if="show"/>
                            </div>
                        </div>
                    </Transition>
                </div>
            </div>
        </Transition>
    </Teleport>
</template>
