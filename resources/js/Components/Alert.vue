<script setup>
import {AlertSuccessIcon, AlertWarningIcon} from '@/Components/Icons/solid';
import Button from "@/Components/Button.vue";
import {computed} from "vue";

const props = defineProps({
    intent: {
        type: String,
        validator(value) {
            return ['success', 'warning', ''].includes(value)
        },
        default: 'success'
    },
    title: String,
    alertButton: {
        type: String,
        default: 'OK'
    },
    show: {
        type: Boolean,
        default: false
    },
    onDismiss: Function
})

const iconComponent = computed(() => {
    const icons = {
        success: AlertSuccessIcon,
        warning: AlertWarningIcon
    }

    return icons[props.intent]
})

function dismiss() {
    props.onDismiss();
}
</script>

<template>
    <teleport to="body">
        <transition leave-active-class="duration-200">
            <div
                v-show="show"
                class="fixed inset-0 z-50"
                scroll-region
            >
                <Transition
                    enter-active-class="ease-out duration-200"
                    enter-from-class="opacity-0"
                    enter-to-class="opacity-100"
                    leave-active-class="ease-in duration-200"
                    leave-from-class="opacity-100"
                    leave-to-class="opacity-0"
                >
                    <div
                        v-show="show"
                        class="fixed inset-0 transform transition-all"
                        @click="dismiss"
                    >
                        <div
                            class="absolute inset-0 bg-gray-800 opacity-75"
                        />
                    </div>
                </Transition>

                <Transition
                    enter-active-class="ease-out duration-300"
                    enter-from-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    enter-to-class="opacity-100 translate-y-0 sm:scale-100"
                    leave-active-class="ease-in duration-200"
                    leave-from-class="opacity-100 translate-y-0 sm:scale-100"
                    leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 w-full max-w-[328px]"
                >
                    <div v-if="props.show" class="px-4 py-8 flex flex-col gap-8 bg-gray-900 rounded-xl w-full max-w-[328px] mx-auto">
                        <div class="flex items-center justify-center">
                            <component :is="iconComponent" />
                        </div>

                        <div class="flex flex-col items-center justify-center">
                            <div class="text-sm font-semibold text-white text-center">
                                {{ title }}
                            </div>
                            <div class="text-xs font-normal text-neutral-400 text-center">
                                <slot />
                            </div>
                        </div>
                        <Button
                            type="button"
                            class="w-full flex justify-center"
                            @click="dismiss"
                        >
                            {{ alertButton ?? 'OK' }}
                        </Button>
                    </div>
                </Transition>
            </div>
        </transition>
    </teleport>
</template>
