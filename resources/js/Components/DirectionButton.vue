<script setup>
const props = defineProps({
    type: {
        type: String,
    },
});
</script>
<template>
    <button
        class="w-8 h-8 bg-white dark:bg-black rounded-full justify-center items-center hidden md:flex absolute z-10 top-28"
    >
        <i v-if="type === 'left'" class="fa-solid fa-chevron-left text-md"></i>
        <i
            v-if="type === 'right'"
            class="fa-solid fa-chevron-right text-md"
        ></i>
    </button>
</template>
