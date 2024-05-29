<script setup>
const props = defineProps({
    value: String,
    invalid: String,
    is_required: {
        type:Boolean,
        default: true,
    }
});
</script>

<template>
    <label class="block text-gray-300 text-xs font-medium">
        <span v-if="props.value" :class="{ 'text-error-500': props.invalid }">{{ props.value }}</span>
        <span v-else><slot /></span>
        <span v-if="is_required" class="text-error-500 text-xs font-medium"> *</span>
    </label>
</template>
