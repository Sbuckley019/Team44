<script setup>
import { ref, toRefs, watch } from "vue";

const props = defineProps({
    selectedSort: {
        type: String,
    },
});

const { selectedSort } = toRefs(props);

watch(
    selectedSort,
    (newVal) => {
        selected.value = newVal;
    },
    { deep: true }
);

const emit = defineEmits(["sortChoice"]);

const sortProducts = (choice) => {
    const sortOption = choice.target.value;
    emit("sortChoice", { type: "sort", value: sortOption });
};

const selected = ref(selectedSort.value);

// Data for sort options
const sortOptions = [
    { value: "LTH", text: "Price: Low to High" },
    { value: "HTL", text: "Price: High to Low" },
    { value: "relevancy", text: "Relevancy" },
    { value: "newest", text: "Newest" },
];
</script>
<template>
    <div class="flex flex-col pt-1">
        <label
            v-for="option in sortOptions"
            :key="option.value"
            class="text-sm text-midgrey font-roboto font-normal py-3"
        >
            <input
                type="radio"
                name="sort"
                :value="option.value"
                v-model="selected"
                class="me-2 w-4 checked:bg-black focus:ring-3 focus:bg-black"
                @focus="sortProducts"
            />
            {{ option.text }}
        </label>
    </div>
</template>
