<script setup>
import { ref } from "vue";
import DoubleSlider from "@/Components/DoubleSlider.vue";
import Dropdown from "@/Components/Dropdown.vue";
import RadioSort from "@/Components/RadioSort.vue";
import RadioFilter from "@/Components/RadioFilter.vue";
const selectedSort = ref("relevancy");
const selectedPriceRange = ref([0, 1000]);
const selectedRating = ref("1");

const emit = defineEmits(["filters"]);

const filtersModified = ref(false);

const resetValuesToDefault = () => {
    selectedSort.value = "relevancy";
    selectedPriceRange.value = [0, 1000];
    selectedRating.value = "1";
    filtersModified.value = false;

    emit("reset", {
        category_id: props.category.id,
    });
};

const updateFilters = ({ type, value }) => {
    if (type === "sort") selectedSort.value = value;
    if (type === "priceRange") selectedPriceRange.value = value;
    if (type === "rating") selectedRating.value = value;

    emit("filters", {
        sort: selectedSort.value,
        minPrice: selectedPriceRange.value[0],
        maxPrice: selectedPriceRange.value[1],
        rating: selectedRating.value,
        category_id: props.category.id,
    });

    filtersModified.value = true;
};

const props = defineProps({
    category: {
        type: Object,
        default: 0,
    },
});
</script>
<template>
    <div
        class="w-80 h-[402px] pr-[3.3rem] ps-8 pt-4 flex-shrink-0 self-start overflow-y-scroll sticky top-36"
    >
        <div
            class="py-5 font-montserrat border-solid border-greyt border-b flex justify-between"
        >
            <h2 class="text-black font-bold text-lg">Filter & Sort</h2>

            <button
                class="text-base"
                :class="{
                    'text-topbord': !filtersModified,
                    'text-black': filtersModified,
                }"
                @click="resetValuesToDefault"
                :disabled="!filtersModified"
            >
                Clear All
            </button>
        </div>

        <Dropdown>
            <template #trigger> Sort By </template>
            <template #content>
                <RadioSort
                    :selectedSort="selectedSort"
                    @sortChoice="updateFilters"
                />
            </template>
        </Dropdown>
        <Dropdown>
            <template #trigger> Price Range </template>
            <template #content>
                <DoubleSlider
                    :selectedPriceRange="selectedPriceRange"
                    @priceRange="updateFilters"
                />
            </template>
        </Dropdown>
        <Dropdown>
            <template #trigger> Rating </template>
            <template #content>
                <RadioFilter
                    :selectedRating="selectedRating"
                    @filterChoice="updateFilters"
                />
            </template>
        </Dropdown>
    </div>
</template>
