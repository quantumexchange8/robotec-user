<script setup>
import { onMounted } from 'vue'
import { sidebarState } from '@/Composables'
import SidebarHeader from '@/Components/Sidebar/SidebarHeader.vue'
import SidebarContent from '@/Components/Sidebar/SidebarContent.vue'
import SidebarFooter from '@/Components/Sidebar/SidebarFooter.vue'

onMounted(() => {
    sidebarState.isOpen = false
})
</script>

<template>
    <transition
        enter-active-class="transition"
        enter-from-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="transition"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
    >
        <div
            v-show="sidebarState.isOpen"
            @click="sidebarState.isOpen = false"
            class="fixed inset-0 z-20 bg-black/50 lg:hidden"
        ></div>
    </transition>

    <aside
        style="
            transition-property: width, transform;
            transition-duration: 150ms;
        "
        :class="[
            'fixed inset-y-0 z-20 flex flex-col space-y-6 bg-gray-900 shadow-lg',
            {
                'translate-x-0 w-full lg:max-w-[360px]':
                    sidebarState.isOpen,
                '-translate-x-full w-full md:hidden':
                    !sidebarState.isOpen,
            },
        ]"
    >
        <SidebarHeader />

        <SidebarContent />

        <SidebarFooter />
    </aside>
</template>
