<script setup>
import { router } from "@inertiajs/vue3";
const props = defineProps({
    contact: {
        type: Object,
    },
});
const markAsRead = (contactId) => {
    props.contact.read = !props.contact.read;
    router.post(route("contact.read", { contactId }), {
        preserveScroll: true,
        onError: (errors) => {
            props.contact.read = !props.contact.read;
        },
    });
};
</script>
<template>
    <div class="w-11/12 p-2">
        <div class="font-bold mb-2">{{ contact.subject }}</div>
        <div class="overflow-auto text-roboto text-sm mb-1.5">
            {{ contact.query }} -{{ contact.name }}
        </div>
        <div class="flex items-center dark:text-white text-gray-600 py-3 gap-4">
            <div class="font-bold uppercase">{{ contact.category }}</div>
            <div class="ms-2.5 italic">{{ contact.email }}</div>
        </div>
    </div>
    <div class="w-1/12 flex items-center justify-center">
        <i
            v-if="contact.read"
            @click="markAsRead(contact.id)"
            class="fa-solid fa-bookmark text-2xl cursor-pointer"
        ></i>
        <i
            v-else
            @click="markAsRead(contact.id)"
            class="fa-regular fa-bookmark text-2xl cursor-pointer"
        ></i>
    </div>
</template>
