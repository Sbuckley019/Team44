<script setup>
import { router } from "@inertiajs/vue3";
const props = defineProps({
    feedback: {
        type: Object,
    },
});
const markAsRead = (feedbackId) => {
    props.feedback.read = !props.feedback.read;
    router.post(route("feedback.read", { feedbackId }), {
        preserveScroll: true,
        onError: (errors) => {
            props.feedback.read = !props.feedback.read;
        },
    });
};
</script>
<template>
    <div class="w-11/12">
        <div class="feedbackText overflow-auto mb-1.5">
            {{ feedback.feedback }} -{{ feedback.name }}
        </div>
        <div class="flex items-center dark:text-white text-gray-600 italic">
            <div
                :style="{
                    '--rating': `${(feedback.rating / 5) * 100}%`,
                }"
                class="stars relative w-24 h-5"
                style="
                    background: url('../images/star-empty.png');
                    background-size: contain;
                "
            >
                <div
                    class="absolute top-0 left-0 h-full"
                    style="
                        background: url('../images/star-full.png');
                        background-size: contain;
                        width: var(--rating);
                    "
                ></div>
            </div>
            <div class="ml-2.5 p-2.5">{{ feedback.email }}</div>
        </div>
    </div>
    <div class="w-1/12 flex items-center justify-center">
        <i
            v-if="feedback.read"
            @click="markAsRead(feedback.id)"
            class="fa-solid fa-bookmark text-2xl cursor-pointer"
        ></i>
        <i
            v-else
            @click="markAsRead(feedback.id)"
            class="fa-regular fa-bookmark text-2xl cursor-pointer"
        ></i>
    </div>
</template>
<style scoped>
.stars {
    background: url("../images/star-empty.png");
    background-size: contain;
    width: 100px;
    height: 20px;
}

.stars::before {
    content: "";
    display: block;
    background: url("../images/star-full.png");
    background-size: contain;
    width: var(--rating);
    height: 100%;
    transition: width 0.3s;
}
</style>
