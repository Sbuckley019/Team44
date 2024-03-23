<script setup>
import UserLayout from "@/Layouts/UserLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
const props = defineProps({
    orders: {
        type: Object,
    },
});
</script>
<template>
    <UserLayout>
        <div class="container">
            <div>
                <div v-if="orders" v-for="order in orders" class="order-item">
                    <div>{{ order.order_id }}</div>
                    <div>{{ order.order_date }}</div>
                    <div>{{ order.total_price }}</div>
                    <div>{{ order.status }}</div>
                    <a href="#">Inspect Order</a>
                </div>

                <div v-else class="flex items-center justify-center">
                    <div>
                        <img
                            src="{{ asset('images/noorder.png') }}"
                            alt="noorder"
                            class="w-96, mx-auto"
                        />
                    </div>
                    <div>
                        <div>
                            <h2>No order placed yet</h2>
                            <p>
                                You don't have any orders placed in your
                                history.
                            </p>
                            <PrimaryButton>Shop Products</PrimaryButton>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </UserLayout>
</template>
