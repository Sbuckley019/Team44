<script setup>
import { computed } from "vue";
import SecondaryButton from "./SecondaryButton.vue";
const props = defineProps({
    selectedCategory: {
        type: String,
    },
    categories: {
        type: Object,
    },
});

const selectedCategory = computed(() => props.selectedCategory);

const emit = defineEmits(["filterCategory"]);

const filterCategories = (category) => {
    emit("filterCategory", { type: "category", value: category.category_name });
};

const getClass = (category) => {
    return selectedCategory.value === category.category_name
        ? "ring-2 ring-black dark:ring-white ring-offset-2"
        : "";
};
</script>
<template>
    <div class="flex flex-col pt-1">
        <SecondaryButton
            v-for="category in categories"
            @click="filterCategories(category)"
            :class="getClass(category)"
            class="mb-2"
            >{{ category.category_name }}</SecondaryButton
        >
    </div>
</template>
