<script setup>
import { ref } from 'vue';
import EmptyHistoryIllustration from '@/Pages/Dashboard/Partials/EmptyHistoryIllustration.vue';

const transaction = ref(true);
</script>

<template>
    <div class="py-5">
            <div 
                v-if="transaction" 
                class="flex flex-col items-start self-stretch rounded-xl"
            >
                <div class="flex py-2 items-center gap-3 self-stretch border-b border-solid border-gray-700">
                    <div class="flex flex-col items-start flex-1">
                        <div class="text-gray-300 text-xs">01/01/2024 09:00:00</div>
                        <div class="max-w-48 self-stretch overflow-hidden text-white text-ellipsis whitespace-nowrap text-sm font-medium">
                            Auto Trading
                        </div>
                    </div>

                    <div class="min-w-fit text-white text-right font-medium">- $ 250.00</div>
                </div>

                <div class="flex py-2 items-center gap-3 self-stretch border-b border-solid border-gray-700">
                    <div class="flex flex-col items-start flex-1">
                        <div class="text-gray-300 text-xs">01/01/2024 09:00:00</div>
                        <div class="max-w-48 self-stretch overflow-hidden text-white text-ellipsis whitespace-nowrap text-sm font-medium">
                            Deposit
                        </div>
                    </div>

                    <div class="min-w-fit text-success-500 text-right font-medium">+ $ 1,000.00</div>
                </div>
            </div>

            <div v-else class="flex py-5 flex-col items-center gap-3 self-stretch">
                <EmptyHistoryIllustration />
                <div class="self-stretch text-gray-300 text-center text-sm">
                    No transactions found
                </div>
            </div>
        </div>
</template>