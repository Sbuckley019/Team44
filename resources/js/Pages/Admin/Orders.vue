<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Header from "@/Components/Header.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TableHeader from "../../Components/TableHeader.vue";
import TableCell from "../../Components/TableCell.vue";
import { router } from "@inertiajs/vue3";
import { ref, computed } from "vue";

const props = defineProps({
    orders: {
        type: Array,
    },
});

const sortField = ref(null);
const sortOrder = ref(null);
const searchTerm = ref("");

const filteredAndSortedOrders = computed(() => {
    const lowerSearchTerm = searchTerm.value.toLowerCase();

    return sortedOrders.value
        .filter((order) => {
            return (
                order.email.toLowerCase().includes(lowerSearchTerm) ||
                order.id.toString().toLowerCase().includes(lowerSearchTerm)
            );
        })
        .sort((a, b) => {
            let valA = a[sortField.value];
            let valB = b[sortField.value];

            if (!isNaN(new Date(valA)) && !isNaN(new Date(valB))) {
                valA = new Date(valA).getTime();
                valB = new Date(valB).getTime();
            } else if (!isNaN(parseFloat(valA)) && !isNaN(parseFloat(valB))) {
                valA = parseFloat(valA);
                valB = parseFloat(valB);
            }

            if (sortOrder.value === "asc") {
                return valA > valB ? 1 : valA < valB ? -1 : 0;
            } else {
                return valA < valB ? 1 : valA > valB ? -1 : 0;
            }
        });
});

const sortedOrders = computed(() => {
    return [...props.orders].sort((a, b) => {
        let valA = a[sortField.value];
        let valB = b[sortField.value];

        if (!isNaN(new Date(valA)) && !isNaN(new Date(valB))) {
            valA = new Date(valA).getTime();
            valB = new Date(valB).getTime();
        } else if (!isNaN(parseFloat(valA)) && !isNaN(parseFloat(valB))) {
            valA = parseFloat(valA);
            valB = parseFloat(valB);
        }

        if (sortOrder.value === "asc") {
            return valA > valB ? 1 : valA < valB ? -1 : 0;
        } else {
            return valA < valB ? 1 : valA > valB ? -1 : 0;
        }
    });
});

const sortOrders = (field) => {
    if (sortField.value === field) {
        sortOrder.value = sortOrder.value === "asc" ? "desc" : "asc";
    } else {
        sortField.value = field;
        sortOrder.value = "desc";
    }

    props.orders.sort((a, b) => {
        let valA = a[sortField.value];
        let valB = b[sortField.value];

        if (sortOrder.value === "asc") {
            return valA > valB ? 1 : -1;
        } else {
            return valA < valB ? 1 : -1;
        }
    });
};

const viewOrder = () => {
    const url = `/Admin/Orders/${orderId}`;
    console.log(`Attempting to navigate to order ${orderId}`);
    router.visit(url);
};

const processOrder = (order) => {};
</script>

<style scoped>
#table tr:nth-child(even) {
    background-color: #f2f2f2;
}
</style>

<template>
    <AdminLayout>
        <div class="font-roboto text-footer dark:text-white mx-auto p-4">
            <Header>Order Management</Header>
            <div class="my-4 flex justify-center">
                <input
                    v-model="searchTerm"
                    type="text"
                    placeholder="Search orders..."
                    class="p-2 border rounded w-80"
                />
            </div>
            <div id="table" class="mt-4 w-full shadow-md">
                <table class="border-collapse w-full">
                    <thead>
                        <tr class="hover:bg-footer">
                            <TableHeader
                                :sortField="sortField"
                                :sortOrder="sortOrder"
                                :header="'id'"
                                @click="sortOrders('id')"
                            >
                                Order ID
                            </TableHeader>
                            <TableHeader
                                :sortField="sortField"
                                :sortOrder="sortOrder"
                                :header="'email'"
                                @click="sortOrders('email')"
                            >
                                Order Email
                            </TableHeader>
                            <TableHeader
                                :sortField="sortField"
                                :sortOrder="sortOrder"
                                :header="'total_price'"
                                @click="sortOrders('total_price')"
                            >
                                Total Price
                            </TableHeader>
                            <TableHeader
                                :sortField="sortField"
                                :sortOrder="sortOrder"
                                :header="'status'"
                                @click="sortOrders('status')"
                            >
                                Status
                            </TableHeader>
                            <TableHeader
                                :sortField="sortField"
                                :sortOrder="sortOrder"
                                :header="'order_date'"
                                @click="sortOrders('order_date')"
                            >
                                Order Date
                            </TableHeader>
                            <TableHeader> Actions </TableHeader>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="order in filteredAndSortedOrders"
                            :key="order.id"
                        >
                            <TableCell>
                                {{ order.id }}
                            </TableCell>
                            <TableCell>
                                {{ order.email }}
                            </TableCell>
                            <TableCell> £{{ order.total_price }} </TableCell>
                            <TableCell>
                                {{ order.status }}
                            </TableCell>
                            <TableCell>
                                {{ order.date }}
                            </TableCell>
                            <TableCell>
                                <SecondaryButton
                                    @click="viewOrder(order.id)"
                                    class="me-3"
                                >
                                    View
                                </SecondaryButton>
                                <SecondaryButton
                                    @click="processOrder(order.id)"
                                >
                                    Process
                                </SecondaryButton>
                            </TableCell>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AdminLayout>
</template>
