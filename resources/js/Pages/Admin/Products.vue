<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Header from "@/Components/Header.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TableHeader from "../../Components/TableHeader.vue";
import TableCell from "../../Components/TableCell.vue";
import { router } from "@inertiajs/vue3";
import { ref, computed } from "vue";

const props = defineProps({
    products: {
        type: Array,
    },
});

const sortField = ref(null);
const sortOrder = ref(null);
const searchTerm = ref("");

const filteredAndSortedProducts = computed(() => {
    const lowerSearchTerm = searchTerm.value.toLowerCase();

    return sortedProducts.value
        .filter((product) => {
            return (
                product.product_name.toLowerCase().includes(lowerSearchTerm) ||
                product.description.toLowerCase().includes(lowerSearchTerm) ||
                product.category_id
                    .toString()
                    .toLowerCase()
                    .includes(lowerSearchTerm)
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

const sortedProducts = computed(() => {
    return [...props.products].sort((a, b) => {
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

const sortProducts = (field) => {
    if (sortField.value === field) {
        sortOrder.value = sortOrder.value === "asc" ? "desc" : "asc";
    } else {
        sortField.value = field;
        sortOrder.value = "desc";
    }

    props.products.sort((a, b) => {
        let valA = a[sortField.value];
        let valB = b[sortField.value];

        if (sortOrder.value === "asc") {
            return valA > valB ? 1 : -1;
        } else {
            return valA < valB ? 1 : -1;
        }
    });
};

const getBackground = (quantity) => {
    const percent = quantity / 20;
    let color;

    if (percent <= 0.5) {
        const green = Math.round(255 * (percent / 0.5));
        color = `rgb(255, ${green}, 0)`;
    } else {
        const red = Math.round(255 * ((1 - percent) / 0.5));
        color = `rgb(${red}, 255, 0)`;
    }

    return color;
};
const addProduct = () => {
    router.visit(route("products.create"));
};

const editProduct = () => {};

const updateQuantity = () => {};

const deleteProduct = () => {};

const applyDiscount = (product_id, discount) => {
    router.post("route");
};
/*Inertia.post("/api/apply-discount", {
    product_id: this.productId,
    discount: this.discount,
});*/
</script>

<template>
    <AdminLayout>
        <div class="font-roboto text-footer dark:text-white mx-auto p-4">
            <Header>Product Management</Header>
            <div class="my-4 flex justify-center relative">
                <input
                    v-model="searchTerm"
                    type="text"
                    placeholder="Search products..."
                    class="p-2 border rounded w-80"
                />
                <SecondaryButton @click="addProduct" class="absolute right-3"
                    >Add new product</SecondaryButton
                >
            </div>

            <div id="table" class="mt-4 w-full shadow-md">
                <table class="border-collapse w-full">
                    <thead>
                        <tr class="hover:bg-footer">
                            <TableHeader
                                :sortField="sortField"
                                :sortOrder="sortOrder"
                                :header="'id'"
                                @click="sortProducts('id')"
                            >
                                ID
                            </TableHeader>
                            <TableHeader
                                :sortField="sortField"
                                :sortOrder="sortOrder"
                                :header="'image_url'"
                                @click="sortProducts('image_url')"
                            >
                                Image
                            </TableHeader>
                            <TableHeader
                                :sortField="sortField"
                                :sortOrder="sortOrder"
                                :header="'product_name'"
                                @click="sortProducts('product_name')"
                            >
                                Name
                            </TableHeader>
                            <TableHeader
                                :sortField="sortField"
                                :sortOrder="sortOrder"
                                :header="'description'"
                                @click="sortProducts('description')"
                            >
                                Description
                            </TableHeader>
                            <TableHeader
                                :sortField="sortField"
                                :sortOrder="sortOrder"
                                :header="'category_id'"
                                @click="sortProducts('category_id')"
                            >
                                Category
                            </TableHeader>
                            <TableHeader
                                :sortField="sortField"
                                :sortOrder="sortOrder"
                                :header="'stock_quantity'"
                                @click="sortProducts('stock_quantity')"
                            >
                                Stock
                            </TableHeader>
                            <TableHeader
                                :sortField="sortField"
                                :sortOrder="sortOrder"
                                :header="'price'"
                                @click="sortProducts('price')"
                            >
                                Price
                            </TableHeader>
                            <TableHeader
                                :sortField="sortField"
                                :sortOrder="sortOrder"
                                :header="'discount'"
                                @click="sortProducts('discount')"
                            >
                                Discount
                            </TableHeader>
                            <TableHeader
                                :sortField="sortField"
                                :sortOrder="sortOrder"
                                :header="'sales'"
                                @click="sortProducts('sales')"
                            >
                                Sales
                            </TableHeader>
                            <TableHeader> Actions</TableHeader>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="product in filteredAndSortedProducts"
                            :key="product.id"
                        >
                            <TableCell>
                                {{ product.id }}
                            </TableCell>
                            <TableCell>
                                <img
                                    :src="product.image_url"
                                    class="max-w-8 mx-auto"
                                />
                            </TableCell>
                            <TableCell>
                                {{ product.product_name }}
                            </TableCell>
                            <TableCell class="max-h-20 overflow-hidden">
                                {{ product.description }}
                            </TableCell>
                            <TableCell>
                                {{ product.category_id }}
                            </TableCell>
                            <TableCell
                                :style="{
                                    backgroundColor: getBackground(
                                        product.stock_quantity
                                    ),
                                }"
                            >
                                {{ product.stock_quantity }}
                            </TableCell>
                            <TableCell> £{{ product.price }} </TableCell>
                            <TableCell>{{ product.discount * 100 }}%</TableCell>
                            <TableCell> £{{ product.sales }} </TableCell>
                            <TableCell :whitespace="true">
                                <SecondaryButton
                                    @click="applyDiscount"
                                    class="w-full text-center justify-center"
                                >
                                    Apply Discount
                                </SecondaryButton>
                                <SecondaryButton
                                    @click="updateQuantity"
                                    class="w-full text-center justify-center"
                                >
                                    update Quantity
                                </SecondaryButton>
                                <SecondaryButton
                                    @click="editProduct"
                                    class="w-full text-center justify-center"
                                >
                                    Edit
                                </SecondaryButton>
                                <SecondaryButton
                                    @click="deleteProduct"
                                    class="w-full text-center justify-center"
                                >
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
