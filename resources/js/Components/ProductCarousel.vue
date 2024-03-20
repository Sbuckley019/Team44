<script setup>
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import ProductCard from "@/Components/ProductCard.vue";
import DirectionButton from "@/Components/DirectionButton.vue";

const props = defineProps({
    products: {
        type: Array,
    },
});

const scrollContainer = ref(null);

const scroll = (direction) => {
    const container = scrollContainer.value;

    if (!container) return;

    const scrollAmount = 340;
    const currentScroll = container.scrollLeft;

    if (direction === "left") {
        container.scrollTo({
            left: currentScroll - scrollAmount,
            behavior: "smooth",
        });
    } else if (direction === "right") {
        container.scrollTo({
            left: currentScroll + scrollAmount,
            behavior: "smooth",
        });
    }
};
</script>
<template>
    <div class="w-full relative overflow-hidden">
        <div
            ref="scrollContainer"
            id="carousel-slide"
            class="ps-2 grid grid-flow-col overflow-auto whitespace-nowrap gap-2 transition-transform duration-500 ease-in-out"
        >
            <ProductCard
                v-for="product in products"
                :key="product.id"
                :product="product"
                :customClass="'w-80'"
            />
        </div>
        <DirectionButton
            class="start-4"
            @click="scroll('left')"
            :type="'left'"
        />
        <DirectionButton
            class="end-4"
            @click="scroll('right')"
            :type="'right'"
        />
    </div>
</template>
<style>
#carousel-slide:hover::-webkit-scrollbar-thumb {
    background-color: #888;
}
#carousel-slide::-webkit-scrollbar {
    height: 8px;
    width: 10px;
}

#carousel-slide::-webkit-scrollbar-thumb {
    width: 3px;
    border-radius: 10px;
    background-color: transparent;
}
</style>
