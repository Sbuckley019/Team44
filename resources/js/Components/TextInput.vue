<script setup>
import { onMounted, ref, defineModel } from "vue";

const model = defineModel({
    type: String,
    required: true,
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute("autofocus")) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>
<template>
    <input
        class="mt-1 font-roboto w-full px-3 py-2 bg-white dark:bg-black border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-black dark:ring-white focus:border-black"
        v-model="model"
        ref="input"
    />
</template>
