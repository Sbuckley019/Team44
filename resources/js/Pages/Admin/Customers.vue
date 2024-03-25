<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Header from "@/Components/Header.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TableHeader from "../../Components/TableHeader.vue";
import TableCell from "../../Components/TableCell.vue";
import { router } from "@inertiajs/vue3";
import { ref, computed } from "vue";

const props = defineProps({
    customers: {
        type: Array,
    },
});

const sortField = ref(null);
const sortOrder = ref(null);
const searchTerm = ref("");

const sortCustomers = (field) => {
    if (sortField.value === field) {
        sortOrder.value = sortOrder.value === "asc" ? "desc" : "asc";
    } else {
        sortField.value = field;
        sortOrder.value = "desc";
    }
};
const filteredAndSortedCustomers = computed(() => {
    const lowerSearchTerm = searchTerm.value.toLowerCase();

    return sortedCustomers.value
        .filter((customer) => {
            return (
                customer.username.toLowerCase().includes(lowerSearchTerm) ||
                customer.email.toLowerCase().includes(lowerSearchTerm) ||
                customer.id.toString().toLowerCase().includes(lowerSearchTerm)
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
const sortedCustomers = computed(() => {
    return [...props.customers].sort((a, b) => {
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

const editCustomer = () => {};

const deleteCustomer = () => {};
</script>
<template>
    <AdminLayout>
        <div class="font-roboto text-footer dark:text-white mx-auto p-4">
            <Header>Customer Management</Header>
            <div class="my-4 flex justify-center">
                <input
                    v-model="searchTerm"
                    type="text"
                    placeholder="Search Customers..."
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
                                @click="sortCustomers('id')"
                            >
                                User ID
                            </TableHeader>
                            <TableHeader
                                :sortField="sortField"
                                :sortOrder="sortOrder"
                                :header="'username'"
                                @click="sortCustomers('username')"
                            >
                                Username
                            </TableHeader>
                            <TableHeader
                                :sortField="sortField"
                                :sortOrder="sortOrder"
                                :header="'email'"
                                @click="sortCustomers('email')"
                            >
                                Email
                            </TableHeader>
                            <TableHeader
                                :sortField="sortField"
                                :sortOrder="sortOrder"
                                :header="'spent'"
                                @click="sortCustomers('spent')"
                            >
                                Spent
                            </TableHeader>
                            <TableHeader
                                :sortField="sortField"
                                :sortOrder="sortOrder"
                                :header="'created_at'"
                                @click="sortCustomers('created_at')"
                            >
                                Registration Date
                            </TableHeader>
                            <TableHeader> Actions </TableHeader>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="customer in filteredAndSortedCustomers"
                            :key="customer.id"
                        >
                            <TableCell>
                                {{ customer.id }}
                            </TableCell>
                            <TableCell>
                                {{ customer.username }}
                            </TableCell>
                            <TableCell>
                                {{ customer.email }}
                            </TableCell>
                            <TableCell> £{{ customer.spent }} </TableCell>
                            <TableCell>
                                {{ customer.created_at }}
                            </TableCell>
                            <TableCell>
                                <SecondaryButton
                                    @click="editCustomer"
                                    class="me-2"
                                >
                                    Edit
                                </SecondaryButton>
                                <SecondaryButton @click="deleteCustomer">
                                    Delete
                                </SecondaryButton>
                            </TableCell>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AdminLayout>
</template>

<style scoped>
#table tr:nth-child(even) {
    background-color: #f2f2f2;
}
</style>
