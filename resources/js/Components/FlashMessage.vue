<template>
    <div
        v-if="visible"
        class="w-full flex justify-center mx-auto absolute bottom-8 z-50"
    >
        <div
            :class="`w-96  flex bg-${color}-100 text-${color}-700 p-2 rounded-lg px-4 justify-between items-center`"
            role="alert"
        >
            <p class="font-bold">{{ message }}</p>
            <button @click="dismiss" class="px-2 py-2">
                <span class="text-2xl">&times;</span>
            </button>
        </div>
    </div>
</template>

<script setup>
import { ref, watch, onMounted } from "vue";

const props = defineProps({
    message: String,
    color: {
        type: String,
        default: "green",
    },
    timeout: {
        type: Number,
        default: 5000,
    },
});

const visible = ref(true);

const dismiss = () => {
    visible.value = false;
};

onMounted(() => {
    setTimeout(() => {
        visible.value = false;
    }, props.timeout);
});
</script>

<style scoped>
button {
    background: none;
    border: none;
}
</style>
