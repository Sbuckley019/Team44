<script setup>
import { onMounted, ref, onUnmounted, toRefs } from "vue";
import UserLayout from "@/Layouts/UserLayout.vue";
import FilterMenu from "@/Components/FilterMenu.vue";
import { router } from "@inertiajs/vue3";
import ProductCard from "@/Components/ProductCard.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Header from "@/Components/Header.vue";

function filterProducts(filters) {
    const routeName =
        props.mode === "favourites" ? "favourite.index" : "products.index";
    router.visit(route(routeName, filters), {
        preserveState: true,
        preserveScroll: true,
        only: ["products", "category"],
    });
}

const hasScrolled = ref(false);

const handleScroll = () => {
    hasScrolled.value = window.scrollY > 0;
};

onMounted(() => {
    checkWindowSize();
    window.addEventListener("scroll", handleScroll);

    window.addEventListener("resize", checkWindowSize);
});

onUnmounted(() => {
    window.removeEventListener("scroll", handleScroll);
    window.removeEventListener("resize", checkWindowSize);
});

const checkWindowSize = () => {
    screenSize.value = window.innerWidth >= 1024 ? "large" : "small";
    if (screenSize.value === "large") {
        visible.value = false;
    } else {
        visible.value = true;
    }
};

const props = defineProps({
    products: {
        type: Object,
    },
    category: {
        type: Object,
    },
    categories: {
        type: Array,
    },
    searchTerm: {
        type: String,
        default: null,
    },
    mode: {
        type: String,
        default: "All Products",
    },
});

const visible = ref(false);

const screenSize = ref("large");

const showFilterMenu = () => {
    visible.value = !visible.value;
};
</script>
<template>
    <UserLayout>
        <div
            class="flex items-center justify-between h-24 lg:h-12 w-full pt-2 px-8 sticky top-24 lg:top-28 z-10 bg-white dark:bg-black transition ease-in duration-300"
            :class="{ 'shadow-custom': hasScrolled }"
        >
            <div class="flex flex-wrap items-center pb-4">
                <h1
                    v-if="searchTerm"
                    class="font-montserrat font-bold text-lg mr-3 text-black dark:text-white uppercase"
                >
                    "{{ searchTerm }}"
                </h1>
                <h1
                    v-else-if="category"
                    class="font-montserrat font-bold text-lg mr-3 text-black dark:text-white uppercase"
                >
                    {{ category.category_name }}
                </h1>
                <h1
                    v-else
                    class="font-montserrat font-bold text-lg mr-3 text-black dark:text-white uppercase"
                >
                    {{ mode }}
                </h1>
                <span
                    class="font-Roboto text-xs leading-6 text-midgrey dark:text-white transform translate-y-1 font-roboto"
                    >{{ Object.keys(products).length }} Products</span
                >
            </div>
            <PrimaryButton
                @click="showFilterMenu"
                class="w-6/12 ms-0 me-0 h-10 lg:hidden"
                >Filter & Sort</PrimaryButton
            >
        </div>

        <div class="flex flex-col lg:flex-row">
            <FilterMenu
                :category="category"
                :categories="categories"
                :searchTerm="searchTerm"
                :is-visible="visible"
                :screen-size="screenSize"
                @filters="(env) => filterProducts(env)"
                @reset="(env) => filterProducts(env)"
                @changeVisibility="showFilterMenu"
            />
            <div
                v-if="products.length > 0"
                class="flex-1 bg-white dark:bg-black grid gap-y-2 gap-x-4 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 p-2.5 pt-0"
            >
                <ProductCard
                    v-for="product in products"
                    :key="product.id"
                    :product="product"
                />
            </div>
            <div
                v-else
                class="flex flex-col justify-center items-center w-full"
            >
                <img
                    v-if="mode !== 'favourites'"
                    src="../../../public/images/Empty_products.png"
                    alt="Empty Products Image"
                    class="mb-4 max-h-60"
                />
                <img
                    v-else
                    src="../../../public/images/Favourites.png"
                    alt="Empty Products Image"
                    class="mb-4 max-h-60"
                />
                <Header class="text-sm"
                    >Unfortunately no products match your chosen filters
                    :(</Header
                >
            </div>
        </div>
    </UserLayout>
</template>
