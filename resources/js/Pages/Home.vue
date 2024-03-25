<script setup>
import Header from "@/Components/Header.vue";
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
            <h2
                class="font-semibold text-xl dark:text-white text-gray-800 leading-tight"
            >
                Home
            </h2>
        </template>

        <div>
            <div>
                <div class="bg-white dark:bg-black overflow-hidden">
                    <div v-if="BestSellingProducts">
                        <div
                            class="bg-image-1 bg-cover h-[480px] flex items-end"
                        >
                            <div
                                class="flex flex-col justify-center py-4 rounded text-white"
                            >
                                <h2
                                    class="ms-4 text-5xl font-bold uppercase font-montserrat my-4"
                                >
                                    With great gains comes great responsibility
                                </h2>
                            </div>
                        </div>
                        <div class="mt-4 mb-8">
                            <Header>Best Selling Products</Header>
                            <ProductCarousel
                                class="pt-8"
                                :products="BestSellingProducts"
                            />
                        </div>
                    </div>
                    <div v-if="NewestProducts">
                        <div
                            class="bg-image-2 bg-cover h-[472px] flex items-end"
                        >
                            <div
                                class="flex flex-col justify-center py-4 rounded text-white"
                            >
                                <h2
                                    class="ms-4 text-5xl font-bold uppercase font-montserrat my-4"
                                >
                                    Shop our newest products
                                </h2>
                            </div>
                        </div>
                        <div class="mt-4 mb-8">
                            <Header>Newest Products</Header>
                            <ProductCarousel
                                class="pt-8"
                                :products="NewestProducts"
                            />
                        </div>
                    </div>
                    <div v-if="MensProducts">
                        <div
                            class="bg-image-3 bg-cover h-[472px] flex items-end"
                        >
                            <div
                                class="flex flex-col justify-center py-4 rounded text-white"
                            >
                                <h2
                                    class="ms-4 text-5xl font-bold uppercase font-montserrat my-4"
                                >
                                    All new mens products
                                </h2>
                                <p class="ms-4">
                                    Be greater with our new selection of mens
                                    products
                                </p>
                            </div>
                        </div>
                        <div class="mt-4 mb-8">
                            <Header>Mens Products</Header>
                            <ProductCarousel
                                class="pt-8"
                                :products="MensProducts"
                            />
                        </div>
                    </div>
                    <div v-if="WomensProducts">
                        <div
                            class="bg-image-4 bg-cover h-[472px] flex items-end"
                        >
                            <div
                                class="flex flex-col justify-center py-4 rounded text-white"
                            >
                                <h2
                                    class="ms-4 text-5xl font-bold uppercase font-montserrat my-4"
                                >
                                    All new womans products
                                </h2>
                                <p class="ms-4">
                                    Dress to impress with our new variety of
                                    womans clothing
                                </p>
                            </div>
                        </div>
                        <div class="mt-4 mb-8">
                            <Header>Womans Products</Header>
                            <ProductCarousel
                                class="pt-8"
                                :products="WomensProducts"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </UserLayout>
</template>
<style scoped>
.bg-image-1 {
    background-image: url("../../../public/images/gordon-cowie-RKrwVMiW-ik-unsplash.jpg");
}

.bg-image-2 {
    background-image: url("../../../public/images/Equipment_image.jpg");
}

.bg-image-3 {
    background-image: url("../../../public/images/man_on_tredmill.jpg");
}

.bg-image-4 {
    background-image: url("../../../public/images/womans_clothing.jpg");
}
</style>
