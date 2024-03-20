<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Link
        :href="href"
        class="block py-3 px-2.5 no-underline font-medium cursor-pointer leading-10 my-0 text-sm hover:text-black"
    >
        <slot />
    </Link>
</template>
