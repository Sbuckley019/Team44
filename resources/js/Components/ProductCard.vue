<script setup>
import { usePage, router, useForm, Link } from "@inertiajs/vue3";
import { useBasketStore } from "@/stores/basket";

const props = defineProps({
    product: {
        type: Object,
    },
    customWidth: {
        type: String,
    },
});

const { auth } = usePage().props;

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

async function addToBasket(productId) {
    try {
        const response = await axios.post(route("basket.add"), { productId });
        useBasketStore().addToBasket(productId, response.data.basket);
        useBasketStore().updateMessage(response.data.message);
    } catch (error) {
        console.error("Error adding product to basket:", error);
    }
}
</script>

<template>
    <Link
        :href="route('product.show', { product_id: product.id })"
        class="group block w-full cursor-pointer"
        as="div"
    >
        <div class="relative h-84 bg-white overflow-hidden w-full">
            <div class="relative">
                <img
                    :src="product.image_url"
                    alt="Product Image"
                    class="w-full h-60"
                />
                <div
                    class="hidden group-hover:flex h-12 absolute w-full bottom-0 bg-greyt justify-center items-center p-6 z-1 overflow-hidden bg-opacity-60"
                >
                    <button
                        class="bg-white border-solid border-1 border-black rounded-md hover:bg-black hover:text-white"
                        @click.stop="addToBasket(product.id)"
                    >
                        <i class="bi bi-bag text-lg px-1.5"></i>
                    </button>
                </div>
            </div>
            <div class="p-2 h-24">
                <div
                    class="flex text-md font-bold text-xs font-roboto absolute right-2"
                >
                    <i class="fa-solid fa-star text-xs me-1"></i
                    >{{ product.rating }}
                </div>
                <div
                    class="font-roboto text-sm font-normal text-dark capitalize"
                >
                    {{ product.product_name }}
                </div>
                <div class="text-sm text-gray-600 mb-0.5" :class="customWidth">
                    {{ product.description }}
                </div>
                <div class="font-roboto text-sm font-bold text-dark capitalize">
                    £{{ product.price }}
                </div>
                <div class="absolute top-2.5 right-2.5">
                    <button
                        class="w-7 h-7 rounded-full bg-white text-black hover:text-black focus:outline-none flex items-center justify-center"
                        @click.stop="isFavourite(product.id)"
                    >
                        <i
                            :class="
                                product.isFavourite
                                    ? 'fas fa-heart'
                                    : 'far fa-heart'
                            "
                            class="text-xs"
                        ></i>
                    </button>
                </div>
            </div>
        </div>
    </Link>
</template>
