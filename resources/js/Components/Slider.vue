<template>
    <div
        class="w-6/12 h-11 bg-white absolute rounded-full border-4 border-gray-200 transition duration-500"
        :style="sliderStyle"
    ></div>
</template>

<script setup>
import { computed, ref, onMounted } from "vue";

const props = defineProps({
    position: {
        type: String,
        required: true,
    },
});

const sliderStyle = computed(() => ({
    left: props.position === "left" ? "0px" : "50%",
    transition: "left 0.3s ease-in-out",
}));
</script>
