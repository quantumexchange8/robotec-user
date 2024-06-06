<script setup>
import { WhiteCheckIcon } from '@/Components/Icons/solid';
import { ProgressCurrentIcon } from '@/Components/Icons/solid';

const props = defineProps({
    step:String,
});

</script>

<template>
    <div class="w-full py-6">
        <div class="mx-auto  min-w-60 relative flex justify-center items-center">
            <!-- Left shape -->
            <div class="absolute left-0 top-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10">
                <div class="flex flex-col items-center">
                    <div class="w-6 h-6 text-lg text-white flex items-center bg-gray-700 rounded-full border-[3px] border-success-500 justify-center">
                        <div class="w-2 h-2 rounded-full text-lg text-white flex items-center bg-success-500"></div>
                    </div>
                    <div class="text-center text-white text-xs font-medium">{{ $t('public.progress_start_here') }}</div>
                </div>
            </div>

            <!-- Center shape -->
            <div 
                v-if="props.step === '0'"
                class="absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10"
            >
                <div class="flex flex-col items-center">
                    <div class="w-6 h-6 text-lg text-white flex items-center rounded-full bg-gray-700 justify-center"></div>
                    <div class="text-center text-white text-xs font-medium">{{ $t('public.progress_step_1') }}</div>
                </div>
            </div>

            <div 
                v-if="props.step === '1' || props.step === '2'"
                class="absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10"
            >
                <div class="flex flex-col items-center">
                    <div class="w-6 h-6 text-lg text-white flex items-center rounded-full bg-success-500 justify-center">
                        <WhiteCheckIcon />
                    </div>
                    <div class="text-center text-white text-xs font-medium">{{ $t('public.progress_step_1') }}</div>
                </div>
            </div>

            <!-- Right shape -->
            <div 
                v-if="props.step === '0' || props.step === '1'"
                class="absolute right-0 top-1/2 transform translate-x-1/2 -translate-y-1/2 z-10"
            >
                <div class="flex flex-col items-center">
                    <div class="w-6 h-6 text-lg text-white flex items-center rounded-full bg-gray-700 justify-center"></div>
                    <div class="text-center text-white text-xs font-medium">{{ $t('public.progress_step_2') }}</div>
                </div>
            </div>

            <div 
                v-if="props.step === '2'"
                class="absolute right-0 top-1/2 transform translate-x-1/2 -translate-y-1/2 z-10"
            >
                <div class="flex flex-col items-center">
                    <div class="w-6 h-6 text-lg text-white flex items-center rounded-full bg-success-500 justify-center">
                        <WhiteCheckIcon />
                    </div>
                    <div class="text-center text-white text-xs font-medium">{{ $t('public.progress_step_2') }}</div>
                </div>
            </div>

            <!-- Progress bar -->
            <div 
                v-if="props.step === '0'"
                class="absolute left-0 bottom-1.5 w-full h-1 rounded-[20px]"
            >
                <!-- Left half -->
                <div class="absolute left-0 top-0 w-1/4 h-full bg-success-500"></div>
                <!-- Right half -->
                <div class="absolute right-0 top-0 w-3/4 h-full bg-gray-700"></div>
            </div>

            <div 
                v-if="props.step === '1'"
                class="absolute left-0 bottom-1.5 w-full h-1 rounded-[20px]"
            >
                <!-- Left half -->
                <div class="absolute left-0 top-0 w-3/4 h-full bg-success-500"></div>
                <!-- Right half -->
                <div class="absolute right-0 top-0 w-1/4 h-full bg-gray-700"></div>
            </div>

            <div 
                v-if="props.step === '2'"
                class="absolute left-0 bottom-1.5 w-full h-1 rounded-[20px]"
            >
                <div class="absolute left-0 top-0 w-full h-full bg-success-500"></div>
            </div>

            <!-- Current -->
            <div 
                v-if="props.step === '0'"
                class="absolute z-10 left-[25%] -bottom-1 transform -translate-x-1/2 -translate-y-1/2"
            >
                <div class="relative">
                    <ProgressCurrentIcon class="absolute bottom-0 -right-3" />
                </div>
            </div>

            <div 
                v-if="props.step === '1'"
                class="absolute z-10 right-[25%] -bottom-1 transform -translate-x-1/2 -translate-y-1/2"
            >
                <div class="relative">
                    <ProgressCurrentIcon class="absolute bottom-0 -right-3" />
                </div>
            </div>
        </div>
    </div>
</template>
