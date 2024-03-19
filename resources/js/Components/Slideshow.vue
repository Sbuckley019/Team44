<template>
    <div class="flex flex-col justify-center space-y-4 w-full px-12">
        <!-- Slides -->
        <div class="flex flex-col justify-center py-4 rounded text-white">
            <h2 class="text-5xl font-bold uppercase font-montserrat my-4">
                {{ slides[currentSlide].title }}
            </h2>
            <p>{{ slides[currentSlide].content }}</p>
        </div>

        <!-- Navigation Dots -->
        <div class="flex space-x-2">
            <button
                v-for="(slide, index) in slides"
                :key="index"
                :class="[
                    'h-2 w-2 rounded-full',
                    currentSlide === index ? 'bg-white' : 'bg-gray-400',
                ]"
                @click="currentSlide = index"
            ></button>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";

const slides = ref([
    {
        title: "Track your orders",
        content: "Keep track the status of your orders",
    },
    {
        title: "Save what you see",
        content:
            "Save your most-loved activewear pieces and accessories to boost your gains",
    },
    { title: "Bazinga", content: "123" },
]);

const currentSlide = ref(0);

const nextSlide = () => {
    currentSlide.value = (currentSlide.value + 1) % slides.value.length;
};

onMounted(() => {
    const interval = setInterval(nextSlide, 8000); // Change slides every 3 seconds
    return () => clearInterval(interval); // Cleanup on component unmount
});
</script>

<style scoped></style>
