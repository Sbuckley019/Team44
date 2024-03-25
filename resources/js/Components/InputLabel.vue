<script setup>
defineProps({
    value: {
        type: String,
    },
});
</script>

<template>
    <label class="font-roboto text-sm font-medium text-midgrey dark:text-white">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
