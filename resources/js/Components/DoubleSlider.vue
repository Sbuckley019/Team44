<script setup>
import { ref, watch, toRefs } from "vue";
import VueSlider from "vue-slider-component";
import "vue-slider-component/theme/default.css";

const props = defineProps({
    selectedPriceRange: {
        type: Array,
    },
});

const { selectedPriceRange } = toRefs(props);

const emit = defineEmits(["priceRange"]);

const sortProducts = () => {
    emit("priceRange", { type: "priceRange", value: range.value });
};

const range = ref(selectedPriceRange.value);

const sliderMin = ref(0);
const sliderMax = ref(1000);

watch(
    selectedPriceRange,
    (newVal) => {
        range.value = [...newVal];
    },
    { deep: true }
);

watch(range, (newValue) => {
    minInput.value = newValue[0];
    maxInput.value = newValue[1];
});

const minInput = ref(0);
const maxInput = ref(1000);

//Updates the slider if the input boxes are changes
const updateSlider = () => {
    const minValue =
        minInput.value !== "" ? parseInt(minInput.value, 10) : sliderMin.value;
    const maxValue =
        maxInput.value !== "" ? parseInt(maxInput.value, 10) : sliderMax.value;

    if (minValue >= maxValue) {
        range.value = [
            Math.min(minValue, maxValue),
            Math.max(minValue, maxValue),
        ];
    } else {
        range.value = [minValue, maxValue];
    }

    emit("priceRange", { type: "priceRange", value: range.value });
};

//Functions to hide and show value on input focus
const clearInputValue = (event) => {
    event.target.value = "";
};

const restoreInputValue = (event, type) => {
    if (type === "min") {
        event.target.value = minInput.value;
    } else if (type === "max") {
        event.target.value = maxInput.value;
    }
};
</script>
<template>
    <div class="w-full">
        <div class="flex justify-between w-full mb-2">
            <div class="relative">
                <input
                    v-numeric-only
                    id="min"
                    type="text"
                    class="w-24 h-12 rounded-md pt-4 pl-2 font-semibold font-montserrat"
                    @focus="clearInputValue($event, 'min')"
                    @blur="restoreInputValue($event, 'min')"
                    @change="updateSlider()"
                    v-model="minInput"
                />
                <div
                    class="absolute top-1 left-2 text-xs font-montserrat font-semibold text-midgrey"
                >
                    Min
                </div>
            </div>
            <div class="relative">
                <input
                    v-numeric-only
                    id="max"
                    type="text"
                    class="w-24 h-12 rounded-md pt-4 pl-2 font-semibold font-montserrat"
                    @focus="clearInputValue($event, 'max')"
                    @blur="restoreInputValue($event, 'max')"
                    @change="updateSlider()"
                    v-model="maxInput"
                />
                <div
                    class="absolute top-1 left-2 text-xs font-montserrat font-semibold text-midgrey"
                >
                    Max
                </div>
            </div>
        </div>
        <VueSlider
            class="w-full"
            v-model="range"
            :min="sliderMin"
            :max="sliderMax"
            :duration="2"
            :process-style="{ backgroundColor: 'black' }"
            tooltip="none"
            :dot-options="{
                focusStyle: {
                    boxShadow: '3px 3px 3px 3px #e7e7e7',
                },
            }"
            @dragEnd="sortProducts"
            @click="sortProducts"
        />
    </div>
</template>
