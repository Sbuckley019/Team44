<script setup>
const props = defineProps({
    value: {
        type: String,
    },
    href: {
        type: String,
        required: true,
    },
});
</script>
<template>
    <a
        :href="href"
        class="relative flex items-center justify-center gap-x-3 rounded-lg px-2 py-2 outline-none cursor-pointer transition duration-75 hover:bg-gray-100 focus-visible:bg-gray-100 dark:hover:bg-white dark:bg-black/5 dark:focus-visible:bg-white dark:bg-black/5"
    >
        <slot />
        <a
            :href="href"
            class="flex-1 truncate text-sm font-medium dark:text-white text-gray-700 dark:dark:text-white text-gray-200"
            >{{ value }}</a
        >
    </a>
</template>
