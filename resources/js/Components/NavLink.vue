<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? "inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-bold font-montserrat leading-5 uppercase dark:text-white dark:text-white text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out"
        : "inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-bold font-montserrat leading-5 uppercase dark:text-white text-black dark:text-white hover:dark:text-white text-gray-700 hover:border-gray-300 focus:outline-none focus:dark:text-white text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out"
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
