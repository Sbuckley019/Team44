<script setup>
import { ref, toRefs, watch } from "vue";
const props = defineProps({
    selectedRating: {
        type: String,
    },
});

const { selectedRating } = toRefs(props);

const emit = defineEmits(["filterChoice"]);

const filterProducts = (choice) => {
    const filterOption = choice.target.value;
    emit("filterChoice", { type: "rating", value: filterOption });
};

const selectedfilter = ref(selectedRating.value);
watch(
    selectedRating,
    (newVal) => {
        selectedfilter.value = newVal;
    },
    { deep: true }
);

// Data for filter options
const filterOptions = [
    { value: "1", text: "1+ Stars" },
    { value: "2", text: "2+ Stars" },
    { value: "3", text: "3+ Stars" },
    { value: "4", text: "4+ Stars" },
];
</script>
<template>
    <div class="flex flex-col pt-1">
        <label
            v-for="option in filterOptions"
            :key="option.value"
            class="text-sm text-midgrey dark:text-white font-roboto font-normal py-3"
        >
            <input
                type="radio"
                name="filter"
                :value="option.value"
                v-model="selectedfilter"
                class="me-2 w-4 checked:bg-black focus:ring-3 focus:bg-black"
                @focus="filterProducts"
            />
            {{ option.text }}
        </label>
    </div>
</template>
