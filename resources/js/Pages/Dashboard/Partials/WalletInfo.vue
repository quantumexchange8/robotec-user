<script setup>
import Button from '@/Components/Button.vue';
import { ChevronRightIcon } from '@/Components/Icons/outline';
import Modal from '@/Components/Modal.vue';
import { onMounted, onUnmounted, ref, watchEffect } from 'vue';
import CashWalletTransactions from '@/Pages/Dashboard/Partials/CashWalletTransactions.vue';
import CommissionWalletTransactions from '@/Pages/Dashboard/Partials/CommissionWalletTransactions.vue';
import InviteHistory from '@/Pages/Dashboard/Partials/InviteHistory.vue';
import { usePage } from '@inertiajs/vue3';

const wallets = ref([]);
const isLoading = ref(false);

const getWallets = async () => {
    try {
        isLoading.value = true
        const response = await axios.get(route('getWallets'));
        wallets.value = response.data;
    } catch (error) {
        console.error('Error refreshing wallets data:', error);
    } finally {
        isLoading.value = false
    }
};

getWallets();

watchEffect(() => {
    if (usePage().props.title !== null) {
        getWallets();
    }
});

const refereeCount = ref(null);
const isLoadingReferee = ref(false);
var intervalId;

const getRefereeCount = async () => {
    try {
        isLoadingReferee.value = true
        const response = await axios.get(route('getDirectClientsCount'));
        refereeCount.value = response.data;
        console.log(refereeCount.value);
    } catch (error) {
        console.error('Error refreshing referee data:', error);
    } finally {
        isLoadingReferee.value = false
    }
};

onMounted(() => {
    getRefereeCount();
    intervalId = setInterval(getRefereeCount, 10000);
});

onUnmounted(() => {
    clearInterval(intervalId);
})

const walletInfoModal = ref(false);
const modalComponent = ref('');

const openWalletInfoModal = (modalType) => {
    walletInfoModal.value = true;

    if (modalType === 'cash_wallet_transactions') {
        modalComponent.value = modalType;
    } else if (modalType === 'commission_wallet_transactions') {
        modalComponent.value = modalType;
    } else if (modalType === 'invite_history') {
        modalComponent.value = modalType;
    }
}

const closeModal = () => {
    walletInfoModal.value = false
}
</script>

<template>
    <div class="flex mx-4 py-6 px-5 flex-col items-center gap-5 rounded-2xl bg-gray-700">
        <div class="flex justify-between items-center self-stretch">
            <div class="flex flex-col items-start gap-1">
                <div class="text-gray-300 text-xs font-medium">{{ $t('public.cash_wallet') }} ($)</div>
                <div 
                    class="flex items-center gap-5 cursor-pointer" 
                    @click="openWalletInfoModal('cash_wallet_transactions')"
                >
                    <div class="text-white text-xl font-semibold">
                        <div v-show="isLoading">
                            {{ $t('public.loading') }}
                        </div>
                        <template v-for="wallet in wallets">
                            <template v-if="wallet.type === 'cash_wallet'">
                                {{ wallet.balance }}
                            </template>
                        </template>
                    </div>
                    <ChevronRightIcon class="text-gray-600"/>
                </div>
            </div> 

            <Button
                type="button"
                :href="route('transaction.deposit')"
                class="text-sm font-semibold"
            >
            {{ $t('public.deposit') }}
            </Button>
        </div>

        <div class="self-stretch border-b border-solid border-gray-600 flex-1"></div>

        <div class="flex items-center gap-7 self-stretch">
            <div class="flex flex-col items-start gap-1 grow w-full">
                <div class="text-gray-300 text-xs font-medium">{{ $t('public.commission') }} ($)</div>
                <div 
                    class="flex items-center gap-5 cursor-pointer" 
                    @click="openWalletInfoModal('commission_wallet_transactions')"
                >
                    <div class="text-white text-xl font-semibold">
                        <div v-show="isLoading" class="text-md">
                            {{ $t('public.loading') }}
                        </div>
                        <template v-for="wallet in wallets">
                            <template v-if="wallet.type === 'commission_wallet'">
                                {{ wallet.balance }}
                            </template>
                        </template>
                    </div>
                    <ChevronRightIcon class="text-gray-600"/>
                </div>
            </div>

            <div class="self-stretch border-l border-solid border-gray-600 flex-1"></div>

            <div class="flex flex-col items-start gap-1 grow w-full">
                <div class="text-gray-300 text-xs font-medium">{{ $t('public.referee') }} (pax)</div>
                <div 
                    class="flex items-center gap-5 cursor-pointer" 
                    @click="openWalletInfoModal('invite_history')"
                >
                    <div class="text-white text-xl font-semibold">
                        <div v-if="isLoadingReferee" class="text-md">
                            {{ $t('public.loading') }}
                        </div>
                        <template v-else>
                            {{ refereeCount }}
                        </template>
                    </div>
                    <ChevronRightIcon class="text-gray-600"/>
                </div>
            </div>
        </div>
    </div>

    <Modal
        :show="walletInfoModal"
        :title="$t('public.'+ modalComponent)"
        @close="closeModal"
    >
        <template v-if="modalComponent === 'cash_wallet_transactions'">
            <CashWalletTransactions />
        </template>

        <template v-if="modalComponent === 'commission_wallet_transactions'">
            <CommissionWalletTransactions />
        </template>

        <template v-if="modalComponent === 'invite_history'">
            <InviteHistory />
        </template>
    </Modal>
</template>