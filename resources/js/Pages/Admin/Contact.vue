<script setup>
import { router } from "@inertiajs/vue3";
import { ref } from "vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Header from "@/Components/Header.vue";
import ContactCard from "../../Components/ContactCard.vue";
const props = defineProps({
    requests: {
        type: Object,
    },
});

const readOrUnread = ref(false);
const queryCategory = ref("all");

const updateRequests = () => {
    router.get(
        route("contact.index", {
            read: readOrUnread.value,
            category: queryCategory.value,
        }),
        {},
        { preserveScroll: true, preserveState: true },
        { only: ["requests"] }
    );
};
</script>
<template>
    <AdminLayout>
        <div class="h-full w-4/5 mx-auto p-4">
            <div class="flex p-2.5 font-roboto text-footer dark:text-white">
                <Header>User Requests</Header>
                <select
                    v-model="queryCategory"
                    @change="updateRequests"
                    class="block rounded-md mt-1 ms-auto"
                >
                    <option :value="'all'">All</option>
                    <option :value="'technical_support'">
                        Technical Support
                    </option>
                    <option :value="'general_inquiry'">General Inquiry</option>
                    <option :value="'billing'">Billing</option>
                </select>
                <select
                    v-model="readOrUnread"
                    @change="updateRequests"
                    class="block rounded-md mt-1 ms-2"
                >
                    <option :value="false">Unread</option>
                    <option :value="true">Read</option>
                </select>
            </div>
            <div
                v-for="request in requests"
                :key="request.id"
                class="flex p-3.5"
            >
                <ContactCard
                    v-if="request.read == readOrUnread"
                    :contact="request"
                />
            </div>
        </div>
        <div v-if="!props.requests.length">There is no requests to review</div>
    </AdminLayout>
</template>
