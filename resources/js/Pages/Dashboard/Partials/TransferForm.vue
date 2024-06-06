<script setup>
import Button from '@/Components/Button.vue';
import { ArrowNarrowUpRightIcon } from '@/Components/Icons/outline';

</script>

<template>
    <div class="pt-5 flex flex-col items-center gap-5">
        <div class="flex flex-col items-center gap-5 self-stretch">
            <div class="flex py-8 px-5 flex-col justify-center items-center gap-3 self-stretch rounded-2xl bg-gray-800">
                <div class="text-gray-300 text-center font-semibold">Current Account Balance</div>
                <div class="flex justify-center items-center gap-3">
                    <div class="text-white text-center text-xxl font-semibold">
                        $ 300.00
                    </div>
                    <div class="flex items-center gap-1">
                        <ArrowNarrowUpRightIcon />
                        <div class="text-success-500 text-center text-sm font-medium">
                            20%
                        </div>
                    </div>
                </div>
            </div>

            <div class="self-stretch text-neutral-400 text-xs">
                Please note that your account balance will be transferred to commission wallet.
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
                    @click="$emit('transferring')"
                >
                    Transfer Now
                </Button>
            </div>
        </div>
    </div>
</template>