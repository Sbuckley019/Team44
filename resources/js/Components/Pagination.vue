<template>
    <nav>
        <ul>
            <li
                v-for="link in firstAndLastLinks"
                :key="link.label"
                v-html="link.label"
                @click="handlePageChange(link.url)"
                class="my-2 me-1 bg-gray-100 border border-gray-200 rounded-md shadow text-gray-900 inline-block font-sans text-base font-medium leading-5 py-1.5 px-4 transition-colors duration-200 ease-in-out"
                :class="[link.url === null ? 'opacity-50' : 'opacity-100']"
            ></li>
        </ul>
    </nav>
</template>

<script setup>
import { computed } from "vue";

const emit = defineEmits(["page-changed"]);
const props = defineProps({
    links: Array,
});

const firstAndLastLinks = computed(() => {
    if (props.links.length <= 1) {
        return props.links;
    }

    return [props.links[0], props.links[props.links.length - 1]];
});

const handlePageChange = (url) => {
    if (url) {
        emit("page-changed", url);
    }
};
</script>
