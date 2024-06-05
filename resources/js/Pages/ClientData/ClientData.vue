<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import InvitedClients from '@/Pages/ClientData/Partials/InvitedClients.vue';

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

            <InvitedClients />
        </div>

    </AuthenticatedLayout>
</template>
