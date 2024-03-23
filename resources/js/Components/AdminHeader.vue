<script setup>
const props = defineProps({
    value: {
        type: String,
    },
});
</script>
<template>
    <div
        class="fi-sidebar-item-button relative flex items-center justify-center gap-x-3 rounded-lg px-2 py-2 outline-none cursor-pointer transition duration-75 hover:bg-gray-100 focus-visible:bg-gray-100 dark:hover:bg-white/5 dark:focus-visible:bg-white/5"
    >
        <slot />
        <span
            href="/"
            class="fi-sidebar-item-label flex-1 truncate text-sm font-medium text-gray-700 dark:text-gray-200"
            >{{ value }}</span
        >
    </div>
</template>
