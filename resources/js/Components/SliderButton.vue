<template>
    <button
        type="button"
        class="py-2 font-montserrat text-xs bg-transparent border-0 outline-none relative uppercase font-bold w-6/12 h-11"
        @click="handleClick"
    >
        {{ buttonText }}
    </button>
    <slot />
</template>
<script setup>
const props = defineProps({
    buttonText: String,
});

const emit = defineEmits(["handle-click"]);

const handleClick = () => {
    emit("handle-click");
};
</script>
