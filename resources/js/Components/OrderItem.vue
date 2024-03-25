<script setup>
import { router, usePage } from "@inertiajs/vue3";
import SecondaryButton from "./SecondaryButton.vue";
import { useBasketStore } from "@/stores/basket";
const props = defineProps({
    orderItem: {
        type: Object,
    },
    orderId: {
        type: Number,
    },
});

const emit = defineEmits(["return"]);

async function addToBasket(productId) {
    try {
        const response = await axios.post(route("basket.add"), { productId });
        useBasketStore().addToBasket(productId, response.data.basket);
        useBasketStore().updateMessage(response.data.message);
    } catch (error) {
        console.error("Error adding product to basket:", error);
    }
}

const returnOrderItem = (productId) => {
    emit("return", { productId: productId, orderId: props.orderId });
};

const writeReview = (productId) => {
    router.visit(route("review.create", { productId }));
};
</script>

<template>
    <div class="flex w-full justify-center md:w-10/12 p-4">
        <div>
            <img
                :src="orderItem.image_url"
                class="h-52 max-w-28 sm:h-40 md:max-w-20 md:h-24 me-3"
            />
        </div>
        <div>
            <div class="font-montserrat font-bold">
                {{ orderItem.product_name }}
            </div>
            <div class="flex py-3 gap-3 flex-col sm:flex-row">
                <SecondaryButton @click="addToBasket(orderItem.id)"
                    >Buy it again</SecondaryButton
                >
                <SecondaryButton @click="writeReview(orderItem.id)"
                    >Review your item</SecondaryButton
                >
                <SecondaryButton @click="returnOrderItem(orderItem.id)"
                    >Return your item</SecondaryButton
                >
            </div>
        </div>
    </div>
</template>
