<script setup>
import { ref, onUnmounted } from "vue";

const props = defineProps({
    title: String, // The title for the dropdown, if you want to pass it as a prop
    contentClasses: {
        type: String,
        default: "pt-3 pb-1 bg-white dark:bg-black mb-3",
    },
    open: {
        type: Boolean,
        default: false,
    },
});

const open = ref(props.open);

const toggleDropdown = () => {
    open.value = !open.value;
};

const closeOnEscape = (e) => {
    if (open.value && e.key === "Escape") {
        open.value = false;
    }
};

window.addEventListener("keydown", closeOnEscape);
onUnmounted(() => window.removeEventListener("keydown", closeOnEscape));
</script>

<template>
    <div class="">
        <div
            class="h-full w-full relative font-montserrat text-black dark:text-white font-bold text-lg py-5 border-solid border-white border-y cursor-pointer"
            @click="toggleDropdown"
        >
            <slot name="trigger">{{ title }}</slot>
            <span class="float-right">
                <i v-if="open" class="fa-solid fa-chevron-up"></i>
                <i v-else class="fa-solid fa-chevron-down"></i
            ></span>
        </div>

        <Transition
            name="dropdown"
            enter-active-class="transition ease-out duration-200"
            enter-class="transform opacity-0 scale-95"
            enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95"
        >
            <div v-show="open" :class="contentClasses">
                <slot name="content" />
            </div>
        </Transition>
    </div>
</template>

<style>
.dropdown-enter-active,
.dropdown-leave-active {
    transition: all 0.2s ease;
}
.dropdown-enter,
.dropdown-leave-to {
    transform: scaleY(0);
    opacity: 0;
    height: 0;
}
.dropdown-enter-to,
.dropdown-leave {
    transform: scaleY(1);
    opacity: 1;
    height: auto;
}
</style>
