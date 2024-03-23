<script setup>
import NavigationBar from "@/Components/NavigationBar.vue";
import ProductCarousel from "@/Components/ProductCarousel.vue";
import UserLayout from "@/Layouts/UserLayout.vue";
import { Head } from "@inertiajs/vue3";
const props = defineProps({
    BestSellingProducts: {
        type: Object,
    },
    NewestProducts: {
        type: Object,
    },
    MensProducts: {
        type: Object,
    },
    WomensProducts: {
        type: Object,
    },
});
</script>

<template>
    <Head title="Home" />
    <UserLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Home
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div v-if="BestSellingProducts">
                        <img
                            src="../../../public/images/gordon-cowie-RKrwVMiW-ik-unsplash.jpg"
                        />
                        <ProductCarousel :products="BestSellingProducts" />
                    </div>
                    <div v-if="NewestProducts">
                        <ProductCarousel :products="NewestProducts" />
                    </div>
                    <div v-if="MensProducts">
                        <ProductCarousel :products="MensProducts" />
                    </div>
                    <div v-if="WomensProducts">
                        <ProductCarousel :products="WomensProducts" />
                    </div>
                </div>
            </div>
        </div>
    </UserLayout>
</template>
