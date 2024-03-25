<template>
    <div :showing="false" class="-me-2 flex items-center lg:hidden">
        <button
            @click="emitToggle()"
            class="inline-flex items-center justify-center p-2 rounded-md dark:text-white text-gray-400 hover:dark:text-white text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:dark:text-white text-gray-500 transition duration-150 ease-in-out"
        >
            <svg
                class="h-6 w-6"
                stroke="currentColor"
                fill="none"
                viewBox="0 0 24 24"
            >
                <path
                    :class="{
                        hidden: showing,
                        'inline-flex': !showing,
                    }"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"
                />
                <path
                    :class="{
                        hidden: !showing,
                        'inline-flex': showing,
                    }"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"
                />
            </svg>
        </button>
    </div>
</template>
<script setup>
const props = defineProps({
    showing: {
        type: Boolean,
        required: true,
    },
});
const emit = defineEmits(["toggle"]);
const emitToggle = () => {
    emit("toggle");
};
</script>
