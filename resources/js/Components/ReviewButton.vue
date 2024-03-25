<script setup>
import { ref } from "vue";
const emit = defineEmits(["marked"]);

const feedbackShown = ref(false);

const handleClick = () => {
    feedbackShown.value = true;
    emit("marked");
};
</script>
<template>
    <button
        v-if="!feedbackShown"
        class="mt-2 mx-0 bg-gray-100 border border-gray-200 rounded-md shadow dark:text-white text-gray-900 inline-block font-sans text-base font-medium leading-5 py-1.5 px-4 transition-colors duration-200 ease-in-out"
        @click="handleClick"
    >
        Helpful
    </button>
    <div
        v-else
        class="review-response flex items-center gap-1 mt-2.5 text-sm text-green-700"
    >
        <i class="fas fa-check-circle"></i>
        <div>Thank you for your feedback</div>
    </div>
</template>
