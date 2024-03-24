<template>
    <AdminLayout>
        <div class="font-roboto text-footer mx-auto p-4">
            <Header>Order Management</Header>
            <div id="table" class="mt-4 w-full shadow-md">
                <table class="border-collapse w-full">
                    <thead>
                        <tr class="hover:bg-footer">
                            <TableHeader> Order ID </TableHeader>
                            <TableHeader> Customer Name </TableHeader>
                            <TableHeader> Total Price </TableHeader>
                            <TableHeader> Status </TableHeader>
                            <TableHeader> Actions </TableHeader>
                            <TableHeader> Order Date </TableHeader>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="order in orders" :key="order.id">
                            <TableCell>
                                {{ order.id }}
                            </TableCell>
                            <TableCell>
                                {{ order.customer_name }}
                            </TableCell>
                            <TableCell> £{{ order.total_price }} </TableCell>
                            <TableCell>
                                {{ order.status }}
                            </TableCell>
                            <TableCell>
                                <SecondaryButton @click="viewOrder(order.id)">
                                    View
                                </SecondaryButton>
                                <SecondaryButton
                                    @click="processOrder(order)"
                                    :disabled="order.status === 'Shipped'"
                                >
                                    Process
                                </SecondaryButton>
                            </TableCell>
                            <TableCell>
                                {{ order.date }}
                            </TableCell>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Header from "@/Components/Header.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TableHeader from "../../Components/TableHeader.vue";
import TableCell from "../../Components/TableCell.vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    orders: {
        type: Array,
    },
});

const viewOrder = () => {
    const url = `/Admin/Orders/${orderId}`;
    console.log(`Attempting to navigate to order ${orderId}`);
    router.visit(url);
};

const processOrder = () => {};
</script>

<style scoped>
#table tr:nth-child(even) {
    background-color: #f2f2f2;
}
</style>