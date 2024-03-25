<script setup>
import { computed } from "vue";
const props = defineProps({
    whitespace: {
        type: Boolean,
        default: false,
    },
});

const whitespace = computed(() => {
    return props.whitespace ? "whitespace-normal" : "whitespace-nowrap";
});
</script>
<template>
    <td
        class="px-1 py-3 text-center border-b border-x text-sm max-w-40 max-y-40 overflow-hidden"
        :class="whitespace"
    >
        <slot />
    </td>
</template>
