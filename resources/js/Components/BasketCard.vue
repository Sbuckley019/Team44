<script setup>
import { usePage, router, useForm, Link } from "@inertiajs/vue3";
import { ref } from "vue";
import QuantitySelect from "./QuantitySelect.vue";
import { useBasketStore } from "@/stores/basket";

const store = useBasketStore();
async function addToBasket(quantity) {
    try {
        const response = await axios.post(route("basket.add"), {
            quantity: quantity,
            productId: props.product.product_id,
        });
        useBasketStore().addToBasket(
            props.product.product_id,
            response.data.basket
        );
        useBasketStore().updateMessage(response.data.message);
    } catch (error) {
        console.error("Error adding product to basket:", error);
    }
}
async function removeFromBasket(productId) {
    try {
        const response = await axios.post(route("basket.remove"), {
            productId,
        });
        store.removeFromBasket(productId);
    } catch (error) {
        console.error("Error adding product to basket:", error);
    }
}
const props = defineProps({
    product: {
        type: Object,
    },
    isCheckout: {
        type: Boolean,
        default: false,
    },
    customWidth: {
        type: String,
    },
    customHeight: {
        type: String,
    },
});

const isFavourite = (productId) => {
    if (auth.user) {
        props.product.isFavourite = !props.product.isFavourite;

        router.post(
            route("favourite.add"),
            { productId },
            {
                preserveScroll: true,
                onError: (errors) => {
                    props.product.isFavourite = !props.product.isFavourite;
                },
            }
        );
    } else {
        router.visit(route("favourite.index"));
    }
};
</script>
<template>
    <div class="flex bg-white w-full relative">
        <Link
            :href="
                route('product.show', { product_name: product.product_name })
            "
            class="block cursor-pointer me-4"
            as="div"
        >
            <div>
                <img
                    :src="product.image_url"
                    alt="Product Image"
                    :class="`w-32 ${customHeight ? customHeight : 'h-40'}`"
                />
            </div>
        </Link>
        <div class="py-3 h-24">
            <div
                class="font-roboto text-base font-normal text-dark mb-0.5 capitalize"
            >
                {{ product.product_name }}
            </div>
            <div class="text-sm text-gray-600 mb-1" :class="customWidth">
                {{ product.description }}
            </div>
            <div
                v-if="product.stock >= 10"
                class="text-xs text-green-600 font-bold mb-1.5"
            >
                In Stock
            </div>
            <div
                v-else-if="product.stock > 1"
                class="text-xs text-red-600 font-bold mb-1.5"
            >
                Low Stock
            </div>
            <div
                v-else-if="product.stock == 1"
                class="text-xs text-red-600 font-bold mb-1.5"
            >
                Last item in stock
            </div>
            <div v-else class="text-xs text-yellow-400 font-bold mb-1.5">
                Currently Unavailable
            </div>
            <div
                v-if="!isCheckout"
                class="font-roboto text-base font-bold text-dark capitalize"
            >
                £{{ product.price }}
            </div>
            <div
                v-else
                class="font-roboto text-base font-bold text-dark capitalize"
            >
                £{{ (product.price * product.quantity).toFixed(2) }}
            </div>
            <div v-if="!isCheckout" class="mt-3 flex gap-4">
                <button
                    class="w-9 h-9 rounded-full bg-lgrey text-black hover:text-black focus:outline-none flex items-center justify-center"
                    @click.stop="isFavourite(product.id)"
                >
                    <i
                        :class="
                            product.isFavourite
                                ? 'fas fa-heart'
                                : 'far fa-heart'
                        "
                        class="text-lg"
                    ></i>
                </button>
                <button
                    class="w-9 h-9 rounded-full bg-lgrey text-black hover:text-black focus:outline-none flex items-center justify-center"
                    @click="removeFromBasket(product.product_id)"
                >
                    <i class="fa-solid fa-trash text-lg"></i>
                </button>
            </div>
        </div>

        <QuantitySelect
            v-if="!isCheckout"
            :totalQty="product.stock > 10 ? 10 : product.stock"
            :selectedQty="product.quantity"
            @quantitySelected="addToBasket"
        />

        <div v-else class="absolute bottom-0 right-0 px-4 font-bold">
            Qty: {{ product.quantity }}
        </div>
    </div>
    <hr v-if="!isCheckout" class="my-6" />
</template>
