<script setup>
import { defineProps } from "vue";
import UserLayout from "@/Layouts/UserLayout.vue";
import OrderCard from "@/Components/OrderCard.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Header from "@/Components/Header.vue";

const props = defineProps({
    orders: Array,
});

const goToProducts = () => {
    router.visit(route("products.index"));
};
</script>

<template>
    <UserLayout>
        <div class="mx-auto py-4 w-full md:w-9/12">
            <Header class="mt-8 text-start">Your Orders</Header>
            <div v-if="orders.length" class="space-y-4">
                <OrderCard
                    v-for="order in orders"
                    :key="order.id"
                    :order="order"
                />
            </div>
            <div v-else class="flex flex-col items-center justify-center py-10">
                <img
                    src="../../../public/images/noorder.png"
                    alt="noorder"
                    class="w-60 mx-auto"
                />
                <h2 class="text-lg font-bold mt-4 mb-6">
                    You currently have not placed any orders.
                </h2>

                <PrimaryButton @click="goToProducts" class="w-96"
                    >Shop Products</PrimaryButton
                >
            </div>
        </div>
    </UserLayout>
</template>
