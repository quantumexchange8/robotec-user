<script setup>
import { WhiteCheckIcon } from '@/Components/Icons/solid';
import { ref } from 'vue';

const props = defineProps({
    step: String,
});

const progress = props.step;
</script>

<template>
    <div class="w-full py-6">
        <div 
            v-if="progress === '0'"
            class="mx-auto w-48 relative flex justify-center items-center"
        >
            <!-- Left shape -->
            <div class="absolute left-0 top-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10">
                <div class="flex flex-col items-center">
                    <div class="w-6 h-6 text-lg text-white flex items-center bg-gray-700 rounded-full border-[3px] border-success-500 justify-center">
                        <div class="w-2 h-2 rounded-full text-lg text-white flex items-center bg-success-500"></div>
                    </div>
                    <div class="text-center text-white text-xs font-medium">{{ $t('public.profile_info') }}</div>
                </div>
            </div>

            <!-- Progress bar -->
            <div class="absolute left-0 bottom-1.5 w-full h-1 bg-gray-700 rounded-[20px]"></div>

            <!-- Right shape -->
            <div class="absolute right-0 top-1/2 transform translate-x-1/2 -translate-y-1/2 z-10">
                <div class="flex flex-col items-center">
                    <div class="w-6 h-6 text-lg text-white flex items-center rounded-full bg-gray-700 justify-center"></div>
                    <div class="text-center text-white text-xs font-medium">{{ $t('public.create_password') }}</div>
                </div>
            </div>
        </div>

        <div 
            v-if="progress === '1'"
            class="mx-auto w-48 relative flex justify-center items-center"
        >
            <!-- Left shape -->
            <div class="absolute left-0 top-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10">
                <div class="flex flex-col items-center">
                    <div class="w-6 h-6 text-lg flex items-center rounded-full bg-success-500 justify-center">
                        <WhiteCheckIcon />
                    </div>
                    <div class="text-center text-white text-xs font-medium">{{ $t('public.profile_info') }}</div>
                </div>
            </div>

            <!-- Progress bar -->
            <div class="absolute left-0 bottom-1.5 w-full h-1 rounded-[20px]">
                <!-- Left half -->
                <div class="absolute left-0 top-0 w-1/2 h-full bg-success-500"></div>
                <!-- Right half -->
                <div class="absolute right-0 top-0 w-1/2 h-full bg-gray-700"></div>
            </div>

            <!-- Center dot -->
            <div class="absolute z-10 left-[50%] -bottom-1 transform -translate-x-1/2 -translate-y-1/2">
                <div class="relative">
                    <div class="w-3 h-3 absolute bottom-1.5 -right-1.5 flex items-center bg-success-900 rounded-full justify-center opacity-50"></div>
                    <div class="w-2 h-2 absolute bottom-2 -right-1 rounded-full flex items-center bg-success-500 border-2 border-gray-700"></div>
                </div>
            </div>

            <!-- Right shape -->
            <div class="absolute right-0 top-1/2 transform translate-x-1/2 -translate-y-1/2 z-10">
                <div class="flex flex-col items-center">
                    <div class="w-6 h-6 text-lg flex items-center rounded-full bg-gray-700 justify-center"></div>
                    <div class="text-center text-white text-xs font-medium">{{ $t('public.create_password') }}</div>
                </div>
            </div>
        </div>

        <div 
            v-if="progress === '2'"
            class="mx-auto w-48 relative flex justify-center items-center"
        >
            <!-- Left shape -->
            <div class="absolute left-0 top-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10">
                <div class="flex flex-col items-center">
                    <div class="w-6 h-6 text-lg flex items-center rounded-full bg-success-500 justify-center">
                        <WhiteCheckIcon />
                    </div>
                    <div class="text-center text-white text-xs font-medium">{{ $t('public.profile_info') }}</div>
                </div>
            </div>

            <!-- Progress bar -->
            <div class="absolute left-0 bottom-1.5 w-full h-1 bg-success-500 rounded-[20px]"></div>

            <!-- Right shape -->
            <div class="absolute right-0 top-1/2 transform translate-x-1/2 -translate-y-1/2 z-10">
                <div class="flex flex-col items-center">
                    <div class="w-6 h-6 text-lg flex items-center rounded-full bg-success-500 justify-center">
                        <WhiteCheckIcon />
                    </div>
                    <div class="text-center text-white text-xs font-medium">{{ $t('public.create_password') }}</div>
                </div>
            </div>
        </div>
    </div>
</template>
