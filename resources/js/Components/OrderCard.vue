<template>
    <div
        class="block w-full mx-auto md:border border-y my-4 md:rounded-md md:shadow border-footer"
    >
        <div
            class="flex items-center sm:flex-row flex-col gap-4 sm:gap-16 px-4 py-4 bg-topback border-b border-footer"
        >
            <div
                class="flex flex-col text-center text-black dark:text-white font-bold text-sm font-roboto"
            >
                <span>Order ID</span>
                <span>{{ order.id }}</span>
            </div>
            <div
                class="flex flex-col text-center sm:text-start text-black dark:text-white font-bold text-sm font-roboto"
            >
                <span>Order Placed</span>
                <span>{{ formatDate(order.order_date) }}</span>
            </div>
            <div
                class="flex flex-col text-center sm:text-start text-black dark:text-white font-bold text-sm font-roboto"
            >
                <span>Total</span>
                <span>£{{ order.total_price }}</span>
            </div>
            <div
                class="flex flex-col text-center sm:text-start text-black dark:text-white font-bold text-sm font-roboto"
            >
                <span>Status</span>
                <span :class="statusColor">
                    {{ order.status }}
                </span>
            </div>
        </div>
        <div v-if="order.order_items.length" class="mt-6 px-4 pb-4">
            <div
                v-for="item in order.order_items"
                :key="item.id"
                class="flex flex-col"
            >
                <OrderItem
                    :orderItem="item.product"
                    :orderId="order.id"
                    @return="returnProduct"
                />
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, defineProps, computed } from "vue";
import OrderItem from "@/Components/OrderItem.vue";
import Header from "./Header.vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    order: Object,
});

const statusColor = computed(() => ({
    "font-bold uppercase": true,
    "text-yellow": props.order.status === "pending",
    "text-green": props.order.status === "shipped",
    "text-black dark:text-white": props.order.status === "delivered",
}));

const formatDate = (dateString) => {
    const options = { year: "numeric", month: "long", day: "numeric" };
    return new Date(dateString).toLocaleDateString(undefined, options);
};

const returnProduct = (order) => {
    router.post(route("order-items.return"), order);
};
</script>
