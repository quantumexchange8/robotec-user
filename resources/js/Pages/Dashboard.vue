<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import NoData from '@/Components/NoData.vue';
import Button from '@/Components/Button.vue';
import { QrCode01Icon } from '@/Components/Icons/outline';
import { ChevronRightIcon } from '@/Components/Icons/outline';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="pt-3 px-4">
                <div class="flex py-2 justify-between items-center self-stretch">
                    <div class="flex flex-col justify-center items-start">
                        <div class="self-stretch text-white text-xs font-medium">Welcome back👋</div>
                        <h2 class="self-stretch text-white text-lg font-semibold">Amanda Watson</h2>
                    </div>
                    <div class="flex items-center gap-3">
                        <Button
                            variant="transparent"
                            type="button"
                            :iconOnly="true"
                            class="border border-solid border-gray-600 bg-gray-900"
                            v-slot="{ iconSizeClasses }"
                        >
                            <QrCode01Icon />
                        </Button>
                        <div class="w-8 h-8 rounded-full">
                            <img src="https://pbs.twimg.com/profile_images/1497716648240836608/0T_n2qXz_400x400.jpg" alt="profile_picture">
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <div class="flex py-6 px-5 flex-col items-center gap-5 rounded-2xl bg-gray-700">
            <div class="flex justify-between items-center self-stretch">
                <div class="flex flex-col items-start gap-1">
                    <div class="text-gray-300 text-xs font-medium">Cash Wallet ($)</div>
                    <div class="flex items-center gap-5">
                        <div class="text-white text-xl font-semibold">0.00</div>
                        <ChevronRightIcon class="text-gray-600"/>
                    </div>
                </div>

                <Button
                    type="button"
                    class="text-sm font-semibold"
                >
                    Deposit
                </Button>
            </div>

            <div class="border-b border-solid border-gray-600 w-full"></div>

            <div class="flex items-center gap-7 self-stretch">
                <div class="flex flex-col items-start gap-1 grow">
                    <div class="text-gray-300 text-xs font-medium">Commission ($)</div>
                    <div class="flex items-center gap-5">
                        <div class="text-white text-xl font-semibold">0.00</div>
                        <ChevronRightIcon class="text-gray-600"/>
                    </div>
                </div>

                <div class="border-l border-solid self-stretch border-gray-600 w-1"></div>

                <div class="flex flex-col items-start gap-1 grow">
                    <div class="text-gray-300 text-xs font-medium">Refree (pax)</div>
                    <div class="flex items-center gap-5">
                        <div class="text-white text-xl font-semibold">0</div>
                        <ChevronRightIcon class="text-gray-600"/>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex pt-5 pb-3 flex-col items-center gap-5">
            <div>progress bar</div>
            
        </div>
    </AuthenticatedLayout>
</template>
