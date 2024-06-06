<script setup>
import EmptyInviteHistoryIllustration from '@/Pages/ClientData/Partials/EmptyInviteHistoryIllustration.vue';
import { ref } from 'vue';
import Modal from '@/Components/Modal.vue';
import ProgressBar from '@/Pages/Dashboard/Partials/ProgressBar.vue';

const is_set = ref(true);
const progress = ref('0');

const clientDataModal = ref(false);

const openClientDataModal = () => {
    clientDataModal.value = true;
}

const closeModal = () => {
    clientDataModal.value = false
}

</script>

<template>
    <div class="flex flex-col items-center gap-1 self-stretch">
        <div class="flex py-1 items-center gap-1 self-stretch">
            <div class="text-gray-300 text-sm">Your Invited Clients</div>
            <div class="border-b border-solid flex-1 rounded-lg border-gray-600"></div>
        </div>

        <div
            v-if="is_set"
            class="grid grid-cols-3 w-full gap-3"
        >
            <div
                @click="openClientDataModal()"
                class="flex min-w-24 py-5 px-2 flex-col justify-center items-center gap-2 flex-1 rounded-2xl bg-gray-800"
            >
                <div class="w-7 h-7 rounded-full overflow-hidden">
                    <img src="https://upload.wikimedia.org/wikipedia/en/a/a9/MarioNSMBUDeluxe.png" alt="">
                </div>
                <div
                    class="self-stretch overflow-hidden text-white text-center text-ellipsis text-xs font-medium whitespace-nowrap"
                >
                    Mario Mario
                </div>
            </div>
        </div>

        <div
            v-else
            class="flex py-5 flex-col items-center gap-3 self-stretch"
        >
            <EmptyInviteHistoryIllustration />
            <div class="self-stretch text-gray-300 text-center text-sm">
                It looks like your invite history is empty. Start inviting friends now to earn commission! 🚀
            </div>
        </div>

    </div>

    <Modal
        :show="clientDataModal"
        title="Client's Progress"
        @close="closeModal"
    >
        <div class="pt-5">
            <div class="flex flex-col items-center gap-5 self-stretch">
                <div class="flex items-start gap-2 self-stretch">
                    <div class="w-9 h-9 rounded-full overflow-hidden">
                        <img src="https://upload.wikimedia.org/wikipedia/en/a/a9/MarioNSMBUDeluxe.png" alt="">
                    </div>
                    <div
                        class="flex flex-col justify-center self-stretch overflow-hidden text-white text-ellipsis font-medium whitespace-nowrap"
                    >
                        Mario Mario
                    </div>
                </div>

                <div class="border-b border-solid border-gray-700 flex flex-1 self-stretch"></div>

                <div class="flex flex-col items-center gap-2 self-stretch">
                    <div class="text-white text-center font-semibold">
                        <div v-if="progress === '0'">
                            No Steps Completed
                        </div>
                        <div v-if="progress === '1'">
                            Client Completed Step 1
                        </div>
                        <div v-if="progress === '2'">
                            Client Completed Steps 1 and 2!
                        </div>
                    </div>

                    <div class="self-stretch text-gray-300 text-center text-xs">
                        <div v-if="progress === '0'">
                            It appears your invited client has not completed any steps yet. Encourage them to get started to unlock the benefits!
                        </div>
                        <div v-if="progress === '1'">
                            Your invited client has successfully completed Step 1. Keep them engaged as they progress through the process!
                        </div>
                        <div v-if="progress === '2'">
                            Your invited client has successfully completed Steps 1 and 2. Great job keeping them engaged through the process!
                        </div>
                    </div>
                </div>

                <div class="max-w-fit">
                    <ProgressBar :step="progress" />
                </div>
            </div>
        </div>
    </Modal>
</template>
