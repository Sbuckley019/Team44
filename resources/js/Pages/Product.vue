<script setup>
import { ref } from "vue";
import { usePage, router } from "@inertiajs/vue3";
import ReviewList from "@/Components/ReviewList.vue";
import UserLayout from "@/Layouts/UserLayout.vue";
import Header from "@/Components/Header.vue";
import ProductCarousel from "@/Components/ProductCarousel.vue";

const props = defineProps({
    product: {
        type: Object,
    },
    mostPurchased: {
        type: Array,
    },
    alsoPurchased: {
        type: Array,
    },
    reviews: {
        type: Object,
    },
});

const isZoomed = ref(false);

const containerStyle = ref({
    backgroundImage: `url('${props.product.image_url}')`,
    backgroundRepeat: "no-repeat",
    backgroundSize: "100% 100%",
});

const handleMouseMove = (e) => {
    if (!isZoomed.value) return;

    const { left, top, width, height } = e.target.getBoundingClientRect();
    const x = ((e.clientX - left) / width) * 100;
    const y = ((e.clientY - top) / height) * 100;

    containerStyle.value.backgroundPosition = `${x}% ${y}%`;
};

const toggleZoom = (end) => {
    isZoomed.value =
        end === "Exit" ? (isZoomed.value = false) : !isZoomed.value;
    containerStyle.value.backgroundSize = isZoomed.value
        ? "200% 200%"
        : "100% 100%";
};

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

const reviewScroll = () => {
    const element = document.getElementById("review");
    if (element) {
        element.scrollIntoView({ behavior: "smooth" });
    }
};
</script>
<template>
    <UserLayout
        ><div class="md:flex mb-4">
            <div
                class="image-container w-full md:w-6/12 relative"
                @mousemove="handleMouseMove"
                @click="toggleZoom"
                @mouseleave="toggleZoom('Exit')"
                :style="containerStyle"
            ></div>
            <div class="flex flex-col items-center py-12 mx-auto">
                <div
                    class="font-roboto font-bold text-xs bg-lgrey rounded p-1.5 mb-3"
                >
                    20% OFF
                </div>
                <Header>
                    {{ product.product_name }}
                </Header>
                <span
                    class="leading-7 block text-gray-500 font-roboto text-xs mb-2"
                    >{{ product.description }}</span
                >
                <div class="font-roboto font-bold text-sm">
                    £{{ product.price }}
                </div>
                <section class="flex flex-row gap-12 py-12 justify-center w-96">
                    <button
                        class="h-8 w-14 rounded-full border-none bg-transparent transition-colors duration-200 ease-out hover:bg-gray-100"
                        @click="reviewScroll"
                    >
                        <i class="fas fa-star text-xs me-0.5"></i>
                        <span class="font-roboto font-bold text-xs">{{
                            product.rating
                        }}</span>
                    </button>
                    <button
                        class="h-8 w-14 rounded-full border-none bg-transparent transition-colors duration-200 ease-out hover:bg-gray-100"
                        @click="isFavourite(product.id)"
                    >
                        <i
                            :class="
                                product.isFavourite
                                    ? 'fas fa-heart'
                                    : 'far fa-heart'
                            "
                            class="text-sm"
                        ></i>
                    </button>
                    <button
                        class="h-8 w-14 rounded-full border-none bg-transparent transition-colors duration-200 ease-out hover:bg-gray-100"
                    >
                        <i class="far fa-copy"></i>
                    </button>
                </section>

                <button
                    class="flex justify-center items-center h-10 w-full rounded-full font-montserrat text-md font-bold uppercase py-7 bg-black text-white border-none sticky bottom-4 md:reletive hover:bg-gray-900"
                    @click="addToBasket"
                >
                    add to bag
                </button>
            </div>
        </div>
        <hr />
        <div class="container product-description2 text-center">
            <Header> Description </Header>
            <p>
                This is an additional description for the product. You can add
                more details here.
            </p>
        </div>
        <hr />
        <div class="text-center">
            <Header> People Also Brought </Header>
            <ProductCarousel :products="mostPurchased" />
        </div>
        <hr />
        <div class="text-center">
            <Header> Best Sellers In This Category </Header>
            <ProductCarousel :products="alsoPurchased" />
        </div>

        <hr id="review" class="mb-16" />
        <div class="container customer-reviews">
            <Header> Customer reviews </Header>
            <ReviewList :reviews="reviews" @scroll="reviewScroll" />
        </div>
    </UserLayout>
</template>
<style>
.image-container {
    height: 450px;
    cursor: zoom-in;
    background-position: center;
}
</style>
