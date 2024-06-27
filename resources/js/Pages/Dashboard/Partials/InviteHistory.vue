<script setup>
import { ref, watchEffect } from 'vue';
import EmptyInviteHistoryIllustration from '@/Pages/Dashboard/Partials/EmptyInviteHistoryIllustration.vue';
import {transactionFormat} from "@/Composables/index.js";
import { usePage } from '@inertiajs/vue3';
import DefaultProfilePhoto from '@/Components/DefaultProfilePhoto.vue';
import Loader from '@/Pages/Dashboard/Partials/Loader.vue';

const { formatDateTime } = transactionFormat();
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
    <div class="py-5">
        <div
            v-if="!empty"
            class="flex flex-col items-start self-stretch rounded-xl"
        >
            <div
                v-for="(client, index) in clients"
                class="flex py-2 items-center gap-3 self-stretch border-b border-solid border-gray-700"
                :class="{ 'border-transparent': index == Object.keys(clients).length - 1 }"
            >
                <div class="w-5 h-5 rounded-full overflow-hidden">
                    <template v-if="client.profile_photo">
                        <img :src="client.profile_photo" alt="profile_picture" />
                    </template>
                    <template v-else>
                        <DefaultProfilePhoto />
                    </template>
                </div>
                <div class="flex flex-col justify-center flex-1 self-stretch">
                    <div class="max-w-36 overflow-hidden text-ellipsis whitespace-nowrap text-white text-sm font-medium">
                        {{ client.name }}
                    </div>
                </div>
                <div class="text-gray-300 text-right text-xs">
                    {{ formatDateTime(client.created_at) }}
                </div>
            </div>

            <div
                v-if="isLoading"
                class="flex flex-col items-center self-stretch text-white text-center text-sm font-medium"
            >
                <Loader />
            </div>
        </div>

        <div
            v-else
            class="py-5 flex flex-col items-center gap-3 self-stretch"
        >
            <EmptyInviteHistoryIllustration />
            <div class="self-stretch text-gray-300 text-center text-xs">
                {{ $t('public.invite_history_empty_desc') }}
            </div>
        </div>
    </div>
</template>