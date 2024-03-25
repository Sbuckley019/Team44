<script setup>
defineProps({
    type: {
        type: String,
        default: "button",
    },
});
</script>

<template>
    <button
        :type="type"
        class="inline-flex items-center px-4 py-2 bg-white dark:bg-black border border-gray-300 rounded-md font-semibold text-xs dark:text-white text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-black dark:ring-white focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
    >
        <slot />
    </button>
</template>
