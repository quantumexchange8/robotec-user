<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Button from '@/Components/Button.vue'
import { GithubIcon } from '@/Components/Icons/brands'

let buttonVariants = [
    "primary",
    "gray",
    "success",
    "danger",
    "transparent",
    "outline",
];

let buttonSizes = ["sm", "base", "lg"]
</script>

<template>
    <AuthenticatedLayout title="Buttons">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">Buttons</h2>
            </div>
        </template>

        <div class="grid items-center gap-6 mt-4">
            <div v-for="variant in buttonVariants" :key="variant" class="grid items-start grid-cols-3 gap-4 justify-items-center">
                <Button v-for="size in buttonSizes" :key="size" :variant="variant" :size="size" disabled>
                    Button
                </Button>
            </div>

            <div v-for="variant in buttonVariants" :key="variant" class="grid items-start grid-cols-3 gap-4 justify-items-center">
                <Button v-for="size in buttonSizes" :key="size" :variant="variant" :size="size" class="justify-center gap-2" v-slot="{ iconSizeClasses }">
                    <GithubIcon aria-hidden="true" :class="iconSizeClasses" />
                    <span>Button</span>
                </Button>
            </div>

            <div v-for="variant in buttonVariants" :key="variant" class="grid items-start grid-cols-3 gap-4 justify-items-center">
                <Button v-for="size in buttonSizes" :key="size" iconOnly :variant="variant" :size="size" class="justify-center gap-2" v-slot="{ iconSizeClasses }">
                    <GithubIcon aria-hidden="true" :class="iconSizeClasses" />
                    <span class="sr-only">Icon only button</span>
                </Button>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
