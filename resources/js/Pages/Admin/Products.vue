<template>
    <AdminLayout>
        <div class="font-roboto text-footer mx-auto p-4">
            <Header>Product Management</Header>
            <div id="table" class="mt-4 w-full shadow-md">
                <table class="border-collapse w-full">
                    <thead>
                        <tr class="hover:bg-footer">
                            <TableHeader> ID </TableHeader>
                            <TableHeader> Image </TableHeader>
                            <TableHeader> Name </TableHeader>
                            <TableHeader> Description </TableHeader>
                            <TableHeader> Category </TableHeader>
                            <TableHeader> Stock </TableHeader>
                            <TableHeader> Price </TableHeader>
                            <TableHeader> Discount </TableHeader>
                            <TableHeader> Actions</TableHeader>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="product in products" :key="product.id">
                            <TableCell>
                                {{ product.id }}
                            </TableCell>
                            <TableCell>
                                <img :src="product.image_url" />
                            </TableCell>
                            <TableCell>
                                {{ product.product_name }}
                            </TableCell>
                            <TableCell>
                                {{ product.description }}
                            </TableCell>
                            <TableCell>
                                {{ product.category_id }}
                            </TableCell>
                            <TableCell>
                                {{ product.stock_quantity }}
                            </TableCell>
                            <TableCell> £{{ product.price }} </TableCell>
                            <TableCell>
                                {{ 1 }}
                            </TableCell>
                            <TableCell>
                                <SecondaryButton @click="applyDiscount">
                                    Apply Discount
                                </SecondaryButton>
                                <SecondaryButton @click="editProduct">
                                    Edit
                                </SecondaryButton>
                                <SecondaryButton @click="deleteProduct">
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

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Header from "@/Components/Header.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TableHeader from "../../Components/TableHeader.vue";
import TableCell from "../../Components/TableCell.vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    products: {
        type: Array,
    },
});

console.log(props.products);

const editProduct = () => {};

const deleteProduct = () => {};

const applyDiscount = () => {};
</script>

<style scoped>
#table tr:nth-child(even) {
    background-color: #f2f2f2;
}
</style>
