<script setup>
import { ref, computed } from "vue";
import { useForm } from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Header from "@/Components/Header.vue";
import ProductCard from "@/Components/ProductCard.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
const props = defineProps({
    categories: {
        type: Object,
    },
});
//<form action="{{ route('products.update', $product) }}"
const form = useForm({
    product_name: "",
    description: "",
    price: "",
    category_id: "",
    stock_quantity: "",
    image: null,
});

const imagePreviewUrl = ref("");

const previewProduct = computed(() => {
    return {
        ...form,
        image_url: imagePreviewUrl.value,
        rating: 5,
    };
});

const onFileChange = (event) => {
    form.image = event.target.files[0];
    if (form.image) {
        const reader = new FileReader();
        reader.onload = (e) => {
            imagePreviewUrl.value = e.target.result;
        };
        reader.readAsDataURL(form.image);
    }
};

const submit = () => {
    form.post(route("products.store"), {
        onSuccess: () => {
            form.reset("image");
        },
        onError: (error) => {
            console.log(error);
        },
    });
};
</script>
<template>
    <AdminLayout>
        <div class="product-form-wrapper">
            <Header>Add New Product</Header>
            <div class="max-w-80 border mx-auto">
                <ProductCard :product="previewProduct" />
            </div>
            <form @submit.prevent="submit">
                <div class="form-field">
                    <InputLabel for="product_name" :value="'Product Name:'" />
                    <TextInput
                        id="product_name"
                        v-model="form.product_name"
                        type="text"
                        required
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors.product_name"
                    />
                </div>

                <div class="form-field">
                    <InputLabel for="description" :value="'Description:'" />
                    <TextInput
                        id="description"
                        v-model="form.description"
                        type="text"
                        required
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors.description"
                    />
                </div>

                <div class="form-field">
                    <InputLabel for="price" :value="'Price:'" />
                    <TextInput
                        id="price"
                        v-model="form.price"
                        type="text"
                        required
                    />
                    <InputError class="mt-2" :message="form.errors.price" />
                </div>

                <div class="form-field">
                    <InputLabel for="category_id" :value="'Category Id:'" />
                    <select
                        class="mt-1 font-roboto w-full px-3 py-2 bg-white dark:bg-black border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-black dark:ring-white focus:border-black"
                        id="category_id"
                        v-model="form.category_id"
                        required
                    >
                        <option
                            v-for="category in categories"
                            :value="category.id"
                        >
                            {{ category.category_name }}
                        </option>
                    </select>
                    <InputError
                        class="mt-2"
                        :message="form.errors.category_id"
                    />
                </div>

                <div class="form-field">
                    <InputLabel
                        for="stock_quantity"
                        :value="'Stock Quantity:'"
                    />
                    <TextInput
                        id="stock_quantity"
                        v-model="form.stock_quantity"
                        type="text"
                        required
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors.stock_quantity"
                    />
                </div>

                <div class="form-field my-4 flex items-center justify-center">
                    <InputLabel for="image" :value="'Image:'" class="me-2" />
                    <input
                        type="file"
                        class="input-field"
                        id="image"
                        @change="onFileChange"
                    />
                    <InputError class="mt-2" :message="form.errors.image" />
                </div>

                <PrimaryButton type="submit">Submit</PrimaryButton>
            </form>
        </div>
    </AdminLayout>
</template>
