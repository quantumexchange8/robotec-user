<script setup>
import RobotecBanner from '@/Pages/Dashboard/Partials/RobotecBanner.vue';
import Button from '@/Components/Button.vue';

</script>

<template>
    <div class="py-5 flex flex-col items-center gap-5 max-w-xs">
        <div class="flex flex-col items-center gap-5 self-stretch">
            <RobotecBanner />

            <div class="flex flex-col items-center gap-2 self-stretch">
                <div class="text-white text-center font-semibold">Purchase Robotec for $250.00</div>

                <div class="self-stretch text-gray-300 text-center text-xs">
                    By purchasing Robotec, $250.00 will be deducted from your cash wallet. Confirm your purchase to proceed and unlock your unique QR code for inviting friends and earning commissions.
                </div>
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
                Purchase
            </Button>
        </div>
    </div>
</template>