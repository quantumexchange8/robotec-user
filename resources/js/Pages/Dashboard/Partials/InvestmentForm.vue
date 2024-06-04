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
                <Label for="select_wallet" value="Select wallet" />
                <div class="text-white">2 Radio button</div>
                <InputError :message="msg" />
            </div>

            <div class="flex flex-col items-start gap-1.5 self-stretch">
                <Label for="amount" value="Fund In Amount" />
                <div class="text-white">4 button group</div>
                <InputError :message="msg" />
            </div>

            <div
                v-if="modalType === 'top_up_capital'"
                class="self-stretch text-neutral-400 text-xs"
            >
                <div class="flex flex-col gap-4">
                    <div>Please note that the minimum trading period is 90 days or longer. Funds in the trading account cannot be withdrawn before the end of this period.</div>
                    <div>By clicking 'confirm', your funds will be locked to start Robotec Auto Trading.</div>
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
                    Cancel
                </Button>

                <Button
                    size="lg"
                    type="button"
                    class="w-full font-semibold"
                >
                    Confirm
                </Button>
            </div>
        </div>
    </div>
</template>