<script setup>
import EmptyInviteHistoryIllustration from '@/Pages/ClientData/Partials/EmptyInviteHistoryIllustration.vue';
import { ref, watchEffect } from 'vue';
import Modal from '@/Components/Modal.vue';
import ProgressBar from '@/Pages/Dashboard/Partials/ProgressBar.vue';
import { usePage } from '@inertiajs/vue3';
import DefaultProfilePhoto from '@/Components/DefaultProfilePhoto.vue';

const clientDataModal = ref(false);
const clientIndex = ref(0);

const openClientDataModal = (index) => {
    clientDataModal.value = true;
    clientIndex.value = index;
}

const closeModal = () => {
    clientDataModal.value = false
}

const isLoading = ref(false);
const clients = ref('');
const empty = ref(false);

const getDirectClients = async () => {
    try {
        isLoading.value = true;
        const response = await axios.get(route('getDirectClients'));
        clients.value = response.data;
    } catch (error) {
        console.error('Error refreshing clients data:', error);
    } finally {
        isLoading.value = false;
        if (clients.value.length === 0) {
            empty.value = true;
        }
    }
};

getDirectClients();

watchEffect(() => {
    if (usePage().props.title !== null || usePage().props.toast !== null) {
        getDirectClients();
    }
});

</script>

<template>
    <div class="flex flex-col items-center gap-1 self-stretch">
        <div class="flex py-1 items-center gap-1 self-stretch">
            <div class="text-gray-300 text-sm">{{ $t('public.your_invited_clients') }}</div>
            <div class="border-b border-solid flex-1 rounded-lg border-gray-600"></div>
        </div>

        <div
            v-if="!empty"
            class="grid grid-cols-3 w-full gap-3"
        >
            <div
                v-for="(client, index) in clients"
                @click="openClientDataModal(index)"
                class="flex min-w-24 py-5 px-2 flex-col justify-center items-center gap-2 flex-1 rounded-2xl bg-gray-800"
            >
                <div class="w-7 h-7 rounded-full overflow-hidden">
                    <template v-if="client.profile_photo">
                        <img :src="client.profile_photo" alt="profile_picture" />
                    </template>
                    <template v-else>
                        <DefaultProfilePhoto />
                    </template>
                </div>
                <div
                    class="self-stretch overflow-hidden text-white text-center text-ellipsis text-xs font-medium whitespace-nowrap"
                >
                    {{ client.name }}
                </div>
            </div>
        </div>

        <div
            v-else
            class="flex py-5 flex-col items-center gap-3 self-stretch"
        >
            <EmptyInviteHistoryIllustration />
            <div class="self-stretch text-gray-300 text-center text-sm">
                {{ $t('public.client_data_empty') }}
            </div>
        </div>

        <div 
            v-if="isLoading"
            class="py-8 self-stretch text-white text-center font-medium"
        >
            {{ $t('public.loading') }}
        </div>
    </div>

    <Modal
        :show="clientDataModal"
        :title="$t('public.client_progress')"
        @close="closeModal"
    >
        <div class="pt-5">
            <div class="flex flex-col items-center gap-5 self-stretch">
                <div class="flex items-start gap-2 self-stretch">
                    <div class="w-9 h-9 rounded-full overflow-hidden">
                        <template v-if="clients[clientIndex].profile_photo">
                            <img :src="clients[clientIndex].profile_photo" alt="profile_picture" />
                        </template>
                        <template v-else>
                            <DefaultProfilePhoto />
                        </template>
                    </div>
                    <div
                        class="flex flex-col justify-center self-stretch overflow-hidden text-white text-ellipsis font-medium whitespace-nowrap"
                    >
                        {{ clients[clientIndex].name }}
                    </div>
                </div>

                <div class="border-b border-solid border-gray-700 flex flex-1 self-stretch"></div>

                <div class="flex flex-col items-center gap-2 self-stretch">
                    <div class="text-white text-center font-semibold">
                        <div v-if="clients[clientIndex].progress === '0'">
                            {{ $t('public.client_progress_0') }}
                        </div>
                        <div v-if="clients[clientIndex].progress === '1'">
                            {{ $t('public.client_progress_1') }}
                        </div>
                        <div v-if="clients[clientIndex].progress === '2'">
                            {{ $t('public.client_progress_2') }}
                        </div>
                    </div>

                    <div class="self-stretch text-gray-300 text-center text-xs">
                        <div v-if="clients[clientIndex].progress === '0'">
                            {{ $t('public.client_progress_0_desc') }}
                        </div>
                        <div v-if="clients[clientIndex].progress === '1'">
                            {{ $t('public.client_progress_1_desc') }}
                        </div>
                        <div v-if="clients[clientIndex].progress === '2'">
                            {{ $t('public.client_progress_2_desc') }}
                        </div>
                    </div>
                </div>

                <div class="max-w-fit">
                    <ProgressBar :step="clients[clientIndex].progress" />
                </div>
            </div>
        </div>
    </Modal>
</template>
