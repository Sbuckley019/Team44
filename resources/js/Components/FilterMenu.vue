<script setup>
import { ref } from "vue";
import DoubleSlider from "@/Components/DoubleSlider.vue";
import Dropdown from "@/Components/Dropdown.vue";
import RadioSort from "@/Components/RadioSort.vue";
import RadioFilter from "@/Components/RadioFilter.vue";
import PrimaryButton from "./PrimaryButton.vue";
import { computed } from "vue";

const props = defineProps({
    category: {
        type: Object,
        default: 0,
    },
    isVisible: {
        type: Boolean,
        default: false,
    },
    screenSize: {
        type: String,
    },
});

const selectedSort = ref("relevancy");
const selectedPriceRange = ref([0, 1000]);
const selectedRating = ref("1");

const filtersModified = ref(false);

const emit = defineEmits(["filters", "changeVisibility"]);

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

const changeVisibility = () => {
    emit("changeVisibility");
};

const menuClass = computed(() => ({
    "slide h-full lg:h-[402px] pr-[3.3rem] ps-8 pt-4 flex-shrink-0 self-start sticky w-11/12 z-10 bg-white top-44 lg:top-50 overflow-y-scroll lg:w-80 lg:top-36": true,
    "hidden lg:block": props.screenSize === "large" || props.isVisible,
    "fixed lg:sticky": props.screenSize === "small",
}));

function beforeEnter() {
    if (props.screenSize !== "large") {
        const el = document.getElementById("god");
        el.classList.add(
            "w-full",
            "bg-footer/75",
            "z-50",
            "top-0",
            "fixed",
            "h-full"
        );
    }
}

function afterLeave() {
    if (props.screenSize !== "large") {
        const el = document.getElementById("god");
        el.classList.remove(
            "w-full",
            "bg-footer/75",
            "z-50",
            "top-0",
            "fixed",
            "h-full"
        );
    }
}
</script>
<template>
    <div id="god" @click="changeVisibility">
        <transition
            name="slide"
            mode="out-in"
            @before-enter="beforeEnter"
            @after-leave="afterLeave"
        >
            <div
                v-if="!isVisible || screenSize === 'large'"
                :class="menuClass"
                @click.stop
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
                <Dropdown class="mb-20">
                    <template #trigger> Rating </template>
                    <template #content>
                        <RadioFilter
                            :selectedRating="selectedRating"
                            @filterChoice="updateFilters"
                        />
                    </template>
                </Dropdown>
                <PrimaryButton
                    v-show="screenSize === 'small' && !isVisible"
                    class="fixed bottom-3"
                    @click="changeVisibility"
                >
                    Show Products
                </PrimaryButton>
            </div>
        </transition>
    </div>
</template>
<style scoped>
.slide-enter-active,
.slide-leave-active {
    transition: transform 0.3s ease;
}
.slide-enter-from,
.slide-leave-to {
    transform: translateX(-100%);
}
</style>
