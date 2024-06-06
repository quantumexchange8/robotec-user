<script setup>
import { ref } from 'vue';
import EmptyInviteHistoryIllustration from '@/Pages/Dashboard/Partials/EmptyInviteHistoryIllustration.vue';

const history = ref(true);
</script>

<template>
    <div class="py-5">
        <div v-if="history" class="flex flex-col items-start self-stretch rounded-xl">
            <div class="flex py-2 items-center gap-3 self-stretch border-b border-solid border-gray-700">
                <div class="w-5 h-5 rounded-full overflow-hidden">
                    <img src="https://upload.wikimedia.org/wikipedia/en/a/a9/MarioNSMBUDeluxe.png" alt="">
                </div>
                <div class="flex flex-col justify-center flex-1 self-stretch">
                    <div class="max-w-36 overflow-hidden text-ellipsis whitespace-nowrap text-white text-sm font-medium">
                        Mario Mario
                    </div>
                </div>
                <div class="text-gray-300 text-right text-xs">
                    01/01/2024 09:00:00
                </div>
            </div>

            <div class="flex py-2 items-center gap-3 self-stretch border-b border-solid border-gray-700">
                <div class="w-5 h-5 rounded-full overflow-hidden">
                    <img src="https://upload.wikimedia.org/wikipedia/en/a/a9/MarioNSMBUDeluxe.png" alt="">
                </div>
                <div class="flex flex-col justify-center flex-1 self-stretch">
                    <div class="max-w-36 overflow-hidden text-ellipsis whitespace-nowrap text-white text-sm font-medium">
                        Mario Mario
                    </div>
                </div>
                <div class="text-gray-300 text-right text-xs">
                    01/01/2024 09:00:00
                </div>
            </div>

            <div class="flex py-2 items-center gap-3 self-stretch border-b border-solid border-gray-700">
                <div class="w-5 h-5 rounded-full overflow-hidden">
                    <img src="https://upload.wikimedia.org/wikipedia/en/a/a9/MarioNSMBUDeluxe.png" alt="">
                </div>
                <div class="flex flex-col justify-center flex-1 self-stretch">
                    <div class="max-w-36 overflow-hidden text-ellipsis whitespace-nowrap text-white text-sm font-medium">
                        Mario Mario
                    </div>
                </div>
                <div class="text-gray-300 text-right text-xs">
                    01/01/2024 09:00:00
                </div>
            </div>
        </div>

        <div v-else class="py-5 flex flex-col items-center gap-3 self-stretch">
            <EmptyInviteHistoryIllustration />
            <div class="self-stretch text-gray-300 text-center text-xs">
                {{ $t('public.invite_history_empty_desc') }}
            </div>
        </div>
    </div>
</template>