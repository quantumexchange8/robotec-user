<script setup>
import Button from '@/Components/Button.vue';
import { PlusIcon } from '@/Components/Icons/outline';
</script>

<template>
    <Button
        variant="outline"
        type="button"
        class="font-semibold flex gap-2"
        v-slot="{ iconSizeClasses }"
        @click="$emit('update:usdtForm', 'add_usdt_address')"
    >
        <PlusIcon />
        {{ $t('public.add_usdt_address') }}
    </Button>
</template>