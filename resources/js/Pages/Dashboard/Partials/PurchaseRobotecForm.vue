<script setup>
import RobotecBanner from '@/Pages/Dashboard/Partials/RobotecBanner.vue';
import Button from '@/Components/Button.vue';
import {useForm} from "@inertiajs/vue3";

const emit = defineEmits([
    'update:productProgressModal',
    'update:button2'
])

const form = useForm({
    amount: '',
})

const submitForm = () => {
    form.post(route('transaction.purchaseItem'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            closeModal();
            emit('update:button2');
        },
    });
}

const closeModal = () => {
    emit('update:productProgressModal', false)
}

</script>

<template>
    <div class="py-5 flex flex-col items-center gap-5 max-w-xs">
        <div class="flex flex-col items-center gap-5 self-stretch">
            <RobotecBanner />

            <div class="flex flex-col items-center gap-2 self-stretch">
                <div class="text-white text-center font-semibold">{{ $t('public.purchase_robotec_modal') }}</div>

                <div class="self-stretch text-gray-300 text-center text-xs">
                    {{ $t('public.purchase_robotec_modal_desc') }}
                </div>
            </div>
        </div>

        <div class="flex pt-8 items-center gap-3 self-stretch">
            <Button
                variant="outline"
                size="lg"
                type="button"
                class="w-full font-semibold"
                @click="closeModal"
            >
                {{ $t('public.cancel') }}
            </Button>

            <Button
                size="lg"
                type="button"
                class="w-full font-semibold"
                :disabled="form.processing"
                @click="submitForm"
            >
                {{ $t('public.purchase') }}
            </Button>
        </div>
    </div>
</template>
