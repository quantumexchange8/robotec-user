<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import InvitedClients from '@/Pages/ClientData/Partials/InvitedClients.vue';
import { ref, watchEffect } from 'vue';

const isLoading = ref(false);
const count = ref(null);

const getDirectClientsCount = async () => {
    try {
        isLoading.value = true;
        const response = await axios.get(route('getDirectClientsCount'));
        count.value = response.data;
    } catch (error) {
        console.error('Error refreshing count data:', error);
    } finally {
        isLoading.value = false;
    }
};

getDirectClientsCount();

watchEffect(() => {
    if (usePage().props.title !== null) {
        getDirectClientsCount();
    }
});

</script>

<template>
    <Head title="Client Data" />

    <AuthenticatedLayout>
        <template #header>
            <div class="text-white text-xl">{{ $t('public.client_data') }}</div>
        </template>

        <div class="flex pb-3 px-4 flex-col items-center gap-3">
            <div class="flex p-3 justify-around items-start gap-3 self-stretch rounded-xl bg-gray-800">
                <div class="flex flex-col items-center w-full">
                    <div class="text-white text-center text-lg font-semibold">
                        <template v-if="count !== null">
                            {{ count }}
                        </template>
                        <span v-else class="text-sm">
                            {{ $t('public.loading') }}
                        </span>
                    </div>
                    <div class="text-white text-center text-xs font-medium">{{ $t('public.client') }}</div>
                    <div class="self-stretch text-gray-300 text-center text-xxs">{{ $t('public.client_data_0') }}</div>
                </div>

                <div class="flex flex-col items-center w-full">
                    <div class="text-white text-center text-lg font-semibold">
                        3 <!--change to dynamic-->
                    </div>
                    <div class="text-white text-center text-xs font-medium">{{ $t('public.client') }}</div>
                    <div class="self-stretch text-gray-300 text-center text-xxs">{{ $t('public.client_data_1') }}</div>
                </div>

                <div class="flex flex-col items-center w-full">
                    <div class="text-white text-center text-lg font-semibold">
                        2 <!--change to dynamic-->
                    </div>
                    <div class="text-white text-center text-xs font-medium">{{ $t('public.client') }}</div>
                    <div class="self-stretch text-gray-300 text-center text-xxs">{{ $t('public.client_data_2') }}</div>
                </div>
            </div>

            <InvitedClients />
        </div>

    </AuthenticatedLayout>
</template>
