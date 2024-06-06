<script setup>
import EmptyHistoryIllustration from '@/Pages/Dashboard/Partials/EmptyHistoryIllustration.vue';
import { ref } from 'vue';

const approval = ref('Pending');
const history = ref(true);

</script>

<template>
    <div class="pt-5">
        <div 
            v-if="history"
            class="flex py-2 items-center gap-3 self-stretch"
        >
            <div class="flex flex-col items-start flex-1">
                <div class="text-gray-300 text-xs">01/01/2024 09:00:00</div>
                <div
                    v-if="approval === 'Approved'"
                    class="text-success-500 text-sm font-medium"
                >
                    {{ $t('public.approved') }}
                </div>
                <div
                    v-else-if="approval === 'Pending'"
                    class="text-warning-500 text-sm font-medium"
                >
                    {{ $t('public.pending') }}
                </div>
                <div
                    v-else-if="approval === 'Rejected'"
                    class="text-error-500 text-sm font-medium"
                >
                    {{ $t('public.rejected') }}
                </div>
            </div>

            <div class="text-white text-right font-medium">$ 250.00</div>
        </div>

        <div 
            v-else 
            class="flex py-5 flex-col items-center gap-3 self-stretch"
        >
            <EmptyHistoryIllustration />
            <div class="self-stretch text-gray-300 text-center text-sm">
                {{ $t('public.no_history_found') }}
            </div>
        </div>
    </div>
</template>
