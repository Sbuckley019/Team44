<script setup>
import { computed, ref, onMounted, onUnmounted } from "vue";

const emit = defineEmits(["quantitySelected"]);
const dropdownRef = ref(null);

const props = defineProps({
    selectedQty: {
        type: Number,
    },
    totalQty: {
        type: Number,
    },
});

const total = props.totalQty ? computed(() => props.totalQty).value : 10;

const selectedQty = computed(() => props.selectedQty);
const dropdownOpen = ref(false);

function toggleDropdown() {
    if (total > 1) {
        dropdownOpen.value = !dropdownOpen.value;

        calculateDropdownPosition();
    }
}

function selectQty(number) {
    emit("quantitySelected", { quantity: number });
}

function handleClickOutside(event) {
    if (dropdownRef.value && !dropdownRef.value.contains(event.target)) {
        dropdownOpen.value = false;
    }
}

onMounted(() => {
    window.addEventListener("click", handleClickOutside);
});

onUnmounted(() => {
    window.removeEventListener("click", handleClickOutside);
});

const dropdownStyle = ref({});

function calculateDropdownPosition() {
    if (!dropdownRef.value) return;

    const { bottom, top, height } = dropdownRef.value.getBoundingClientRect();
    const viewportHeight = window.innerHeight;
    const spaceBelow = viewportHeight - bottom;
    const spaceAbove = top;

    if (spaceAbove > spaceBelow && spaceAbove > height) {
        dropdownStyle.value = { bottom: "100%" };
    } else {
        dropdownStyle.value = {};
    }
}
</script>

<template>
    <div
        class="absolute bottom-0 right-0"
        ref="dropdownRef"
        @click.stop="toggleDropdown"
    >
        <div :class="{ 'cursor-pointer': total > 1 }">
            <div
                class="flex justify-between items-center w-full bg-white dark:bg-black text-black dark:text-white px-4 rounded leading-tight"
            >
                <span class="font-bold">Qty: {{ selectedQty }}</span>
                <i
                    v-if="total > 1"
                    class="fa-solid fa-chevron-down text-xs"
                ></i>
            </div>
        </div>

        <div
            v-show="dropdownOpen"
            :style="dropdownStyle"
            class="w-20 bg-white dark:bg-black border border-gray-200 rounded shadow absolute z-10"
        >
            <ul class="list-reset">
                <li
                    v-for="number in total"
                    :key="number"
                    @click="selectQty(number)"
                    class="px-2 hover:bg-gray-100 cursor-pointer font-roboto text-sm h-6 flex items-center"
                >
                    {{ number }}
                </li>
            </ul>
        </div>
    </div>
</template>
