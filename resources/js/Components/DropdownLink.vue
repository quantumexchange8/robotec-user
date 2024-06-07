<script setup>
import {Link} from '@inertiajs/vue3'

defineProps({
    href: String
});
</script>

<template>
    <Link
        v-if="href"
        :href="href"
        class="block w-full p-3 text-sm leading-5 text-left text-white transition duration-150 ease-in-out rounded-lg hover:bg-gray-300 focus:outline-none focus:bg-gray-300 dark:focus:text-white dark:focus:bg-dark-eval-3 dark:text-white dark:hover:text-white dark:hover:bg-gray-800"
    >
        <slot/>
    </Link>
    <span
        v-else
        class="block w-full p-3 text-sm leading-5 text-left text-white transition duration-150 ease-in-out rounded-lg hover:bg-gray-300 focus:outline-none focus:bg-gray-300 dark:focus:text-white dark:focus:bg-dark-eval-3 dark:text-white dark:hover:text-white dark:hover:bg-gray-800 cursor-pointer"
    >
      <slot/>
    </span>

</template>
