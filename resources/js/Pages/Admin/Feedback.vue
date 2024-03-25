<script setup>
import { router } from "@inertiajs/vue3";
import { ref } from "vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Header from "@/Components/Header.vue";
import FeedbackCard from "../../Components/FeedbackCard.vue";
const props = defineProps({
    feedback: {
        type: Object,
    },
});

const readOrUnread = ref(false);

const switchType = () => {
    router.get(
        route("feedback.index"),
        { read: readOrUnread.value },
        { preserveScroll: true, preserveState: true },
        { only: ["feedback"] }
    );
};
</script>
<template>
    <AdminLayout>
        <div class="h-full w-4/5 mx-auto p-4">
            <div class="flex p-2.5 font-roboto text-footer dark:text-white">
                <Header>User Feedback</Header>
                <select
                    v-model="readOrUnread"
                    @change="switchType"
                    class="block rounded-md mt-1 ms-auto"
                >
                    <option :value="false">Unread</option>
                    <option :value="true">Read</option>
                </select>
            </div>
            <div
                v-for="record in props.feedback"
                :key="record.id"
                class="flex p-3.5"
            >
                <FeedbackCard
                    v-if="record.read == readOrUnread"
                    :feedback="record"
                />
            </div>
        </div>
        <div v-if="!props.feedback.length">There is no feedback to review</div>
    </AdminLayout>
</template>
