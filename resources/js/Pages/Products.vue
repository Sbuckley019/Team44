<script setup>
import { onMounted, ref, onUnmounted, toRefs } from "vue";
import UserLayout from "@/Layouts/UserLayout.vue";
import FilterMenu from "@/Components/FilterMenu.vue";
import { router } from "@inertiajs/vue3";
import ProductCard from "@/Components/ProductCard.vue";

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
    window.addEventListener("scroll", handleScroll);
});

onUnmounted(() => {
    window.removeEventListener("scroll", handleScroll);
});

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
    favouriteIds: {
        type: Array,
    },
    mode: {
        type: String,
        default: "All Products",
    },
});
</script>
<template>
    <UserLayout>
        <div
            class="h-12 w-full pt-2 px-8 sticky top-28 z-50 bg-white transition ease-in duration-300"
            :class="{ 'shadow-custom': hasScrolled }"
        >
            <div class="flex flex-wrap items-center pb-4">
                <h1
                    v-if="category"
                    class="font-montserrat font-bold text-lg mr-3 text-black uppercase"
                >
                    {{ category.category_name }}
                </h1>
                <h1
                    v-else
                    class="font-montserrat font-bold text-lg mr-3 text-black uppercase"
                >
                    {{ mode }}
                </h1>
                <span
                    class="font-Roboto text-xs leading-6 text-midgrey transform translate-y-1 font-roboto"
                    >{{ Object.keys(products).length }} Products</span
                >
            </div>
        </div>

        <div class="flex flex-col lg:flex-row">
            <FilterMenu
                :category="category"
                @filters="(env) => filterProducts(env)"
                @reset="(env) => filterProducts(env)"
            />
            <div
                class="flex-1 bg-white grid gap-y-2 gap-x-4 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 p-2.5 pt-0"
            >
                <ProductCard
                    v-for="product in products"
                    :key="product.id"
                    :product="product"
                />
            </div>
        </div>
    </UserLayout>
</template>
