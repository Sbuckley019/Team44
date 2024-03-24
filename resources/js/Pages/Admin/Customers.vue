<template>
    <AdminLayout>
        <div class="font-roboto text-footer mx-auto p-4">
            <Header>Customer Management</Header>
            <div id="table" class="mt-4 w-full shadow-md">
                <table class="border-collapse w-full">
                    <thead>
                        <tr class="hover:bg-footer">
                            <TableHeader> User ID </TableHeader>
                            <TableHeader> Username </TableHeader>
                            <TableHeader> Email </TableHeader>
                            <TableHeader> Spent </TableHeader>
                            <TableHeader> Actions </TableHeader>
                            <TableHeader> Registration Date </TableHeader>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="customer in customers" :key="customer.id">
                            <TableCell>
                                {{ customer.id }}
                            </TableCell>
                            <TableCell>
                                {{ customer.username }}
                            </TableCell>
                            <TableCell>
                                {{ customer.email }}
                            </TableCell>
                            <TableCell>
                                {{ 1 }}
                            </TableCell>
                            <TableCell>
                                <SecondaryButton @click="editCustomer">
                                    Edit
                                </SecondaryButton>
                                <SecondaryButton @click="deleteCustomer">
                                    Delete
                                </SecondaryButton>
                            </TableCell>
                            <TableCell>
                                {{ customer.created_at }}
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
    customers: {
        type: Array,
    },
});

console.log(props.customers);

const editCustomer = () => {};

const deleteCustomer = () => {};
</script>

<style scoped>
#table tr:nth-child(even) {
    background-color: #f2f2f2;
}
</style>
