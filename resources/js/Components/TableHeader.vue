<script setup>
const props = defineProps({
    sortField: {
        type: String,
        default: null,
    },
    sortOrder: {
        type: String,
        default: null,
    },
    header: {
        type: String,
        default: null,
    },
});
</script>
<template>
    <th
        class="bg-footer text-white whitespace-nowrap text-center border-b cursor-pointer"
    >
        <slot />
        <span v-if="sortField && sortField == header">
            <i v-if="sortOrder === 'asc'" class="fa-solid fa-chevron-up"></i>
            <i v-else class="fa-solid fa-chevron-down"></i>
        </span>
    </th>
</template>
