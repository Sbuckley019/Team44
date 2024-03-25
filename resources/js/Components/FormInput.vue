<script setup>
const props = defineProps({
    type: {
        type: String,
        default: "text",
    },
});
</script>
<template>
    <input
        :type="type"
        required
        class="mt-1 font-roboto w-full px-3 py-2 bg-white dark:bg-black border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-black dark:ring-white focus:border-black"
    />
</template>
