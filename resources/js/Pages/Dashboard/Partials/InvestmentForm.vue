<script setup>
import Input from '@/Components/Input.vue';
import Label from '@/Components/Label.vue';
import Button from '@/Components/Button.vue';
import InputError from '@/Components/InputError.vue';
import { ref } from "vue";

const props = defineProps({
    modalType: String,
});

const selectWallet = ref('');
const fundInAmount = ref('');
const msg = ''
</script>

<template>
    <div class="py-5">
        <div class="flex flex-col items-center gap-5 self-stretch">
            <div class="flex flex-col items-start gap-1.5 self-stretch">
                <Label for="select_wallet" :value="$t('public.select_wallet')" :invalid="msg" />
                <div class="text-white">2 Radio button</div>
                <InputError :message="msg" />
            </div>

            <div class="flex flex-col items-start gap-1.5 self-stretch">
                <Label for="amount" :value="$t('public.fund_in_amount')" :invalid="msg" />
                <div class="text-white">4 button group</div>
                <InputError :message="msg" />
            </div>

            <div
                v-if="modalType === 'top_up_capital'"
                class="self-stretch text-neutral-400 text-xs"
            >
                <div class="flex flex-col gap-4">
                    <div>{{ $t('public.top_up_desc_1') }}</div>
                    <div>{{ $t('public.top_up_desc_2') }}</div>
                </div>
            </div>

            <div class="flex pt-8 items-center gap-3 self-stretch">
                <Button
                    variant="outline"
                    size="lg"
                    type="button"
                    class="w-full font-semibold"
                    @click="$emit('closeModal')"
                >
                    {{ $t('public.cancel') }}
                </Button>

                <Button
                    size="lg"
                    type="button"
                    class="w-full font-semibold"
                    @click="$emit('investment')"
                >
                    {{ $t('public.confirm') }}
                </Button>
            </div>
        </div>
    </div>
</template>