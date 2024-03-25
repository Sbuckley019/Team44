<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Header from "@/Components/Header.vue";

const props = defineProps({
    totalCustomers: {
        type: Number,
        default: 0,
    },
    totalOrders: {
        type: Number,
        default: 0,
    },
    totalSales: {
        type: Number,
        default: 0,
    },
    lowStock: {
        type: Number,
        default: 0,
    },
});
</script>
<template>
    <AdminLayout>
        <div
            class="dashboard-container flex flex-col justify-center items-center"
        >
            <Header>Dashboard</Header>
            <div class="grid grid-rows-2 grid-cols-2 px-20 gap-10">
                <div
                    class="p-10 flex flex-col justify-center items-center max-w-72 max-h-40 border rounded-md bg-greyt font-montserrat font-bold"
                >
                    <h3>Total Orders</h3>
                    <p>{{ totalOrders }}</p>
                </div>
                <div
                    class="p-10 flex flex-col justify-center items-center max-w-72 max-h-40 border rounded-md bg-greyt font-montserrat font-bold"
                >
                    <h3>Total Sales</h3>
                    <p>{{ totalSales }}</p>
                </div>
                <div
                    class="p-10 flex flex-col justify-center items-center max-w-72 max-h-40 border rounded-md bg-greyt font-montserrat font-bold"
                >
                    <h3>Low Inventory</h3>
                    <p>{{ lowStock }}</p>
                </div>
                <div
                    class="p-10 flex flex-col justify-center items-center max-w-72 max-h-40 border rounded-md bg-greyt font-montserrat font-bold"
                >
                    <h3>Total Customers</h3>
                    <p>{{ totalCustomers }}</p>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
