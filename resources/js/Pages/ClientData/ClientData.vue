<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import EmptyInviteHistoryIllustration from './Partials/EmptyInviteHistoryIllustration.vue';
import { ref } from 'vue';

const is_set = ref(true);
</script>

<template>
    <Head title="Client Data" />

    <AuthenticatedLayout>
        <template #header>
            <div class="text-white text-xl">Client Data</div>
        </template>

        <div class="flex pb-3 px-4 flex-col items-center gap-3">
            <div class="flex p-3 justify-around items-start gap-3 self-stretch rounded-xl bg-gray-800">
                <div class="flex flex-col items-center">
                    <div class="text-white text-center text-lg font-semibold">5</div>
                    <div class="text-white text-center text-xs font-medium">Client</div>
                    <div class="self-stretch text-gray-300 text-center text-xxs">signed up with your QR code</div>
                </div>

                <div class="flex flex-col items-center">
                    <div class="text-white text-center text-lg font-semibold">3</div>
                    <div class="text-white text-center text-xs font-medium">Client</div>
                    <div class="self-stretch text-gray-300 text-center text-xxs">completed Step 1</div>
                </div>

                <div class="flex flex-col items-center">
                    <div class="text-white text-center text-lg font-semibold">2</div>
                    <div class="text-white text-center text-xs font-medium">Client</div>
                    <div class="self-stretch text-gray-300 text-center text-xxs">completed Step 2</div>
                </div>
            </div>

            <div class="flex flex-col items-center gap-1 self-stretch">
                <div class="flex py-1 items-center gap-1 self-stretch">
                    <div class="text-gray-300 text-sm">Your Invited Clients</div>
                    <div class="border-b border-solid flex-1 rounded-lg border-gray-600"></div>
                </div>

                <div v-if="is_set" class="flex items-center content-center gap-3 self-stretch flex-wrap">
                    <div class="flex min-w-24 py-5 px-2 flex-col justify-center items-center gap-2 flex-1 rounded-2xl bg-gray-800">
                        <div class="w-7 h-7 rounded-full overflow-hidden">
                            <img src="https://upload.wikimedia.org/wikipedia/en/a/a9/MarioNSMBUDeluxe.png" alt="">
                        </div>
                        <div class="self-stretch overflow-hidden text-white text-center text-ellipsis text-xs font-medium whitespace-nowrap">Mario Mario</div>
                    </div>

                    <div class="flex min-w-24 py-5 px-2 flex-col justify-center items-center gap-2 flex-1 rounded-2xl bg-gray-800">
                        <div class="w-7 h-7 rounded-full overflow-hidden">
                            <img src="https://upload.wikimedia.org/wikipedia/en/a/a9/MarioNSMBUDeluxe.png" alt="">
                        </div>
                        <div class="self-stretch overflow-hidden text-white text-center text-ellipsis text-xs font-medium whitespace-nowrap">Mario Mario asdasdasdasdasdsdasd</div>
                    </div>

                    <div class="flex min-w-24 py-5 px-2 flex-col justify-center items-center gap-2 flex-1 rounded-2xl bg-gray-800">
                        <div class="w-7 h-7 rounded-full overflow-hidden">
                            <img src="https://upload.wikimedia.org/wikipedia/en/a/a9/MarioNSMBUDeluxe.png" alt="">
                        </div>
                        <div class="self-stretch overflow-hidden text-white text-center text-ellipsis text-xs font-medium whitespace-nowrap">Mario Mario asdasdasdasdasdsdasd</div>
                    </div>

                    <div class="flex min-w-24 py-5 px-2 flex-col justify-center items-center gap-2 flex-1 rounded-2xl bg-gray-800">
                        <div class="w-7 h-7 rounded-full overflow-hidden">
                            <img src="https://upload.wikimedia.org/wikipedia/en/a/a9/MarioNSMBUDeluxe.png" alt="">
                        </div>
                        <div class="self-stretch overflow-hidden text-white text-center text-ellipsis text-xs font-medium whitespace-nowrap">Mario Mario asdasdasdasdasdsdasd</div>
                    </div>

                    <div class="flex min-w-24 py-5 px-2 flex-col justify-center items-center gap-2 flex-1 rounded-2xl bg-gray-800">
                        <div class="w-7 h-7 rounded-full overflow-hidden">
                            <img src="https://upload.wikimedia.org/wikipedia/en/a/a9/MarioNSMBUDeluxe.png" alt="">
                        </div>
                        <div class="self-stretch overflow-hidden text-white text-center text-ellipsis text-xs font-medium whitespace-nowrap">Mario Mario asdasdasdasdasdsdasd</div>
                    </div>
                </div>
                <div v-else class="flex py-5 flex-col items-center gap-3 self-stretch">
                    <EmptyInviteHistoryIllustration />
                    <div class="self-stretch text-gray-300 text-center text-sm">
                        It looks like your invite history is empty. Start inviting friends now to earn commission! 🚀
                    </div>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>