<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Header from "@/Components/Header.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import UserLayout from "@/Layouts/UserLayout.vue";

const form = useForm({
    name: "",
    email: "",
    subject: "",
    category: "",
    query: "",
});

const formSubmitted = ref(false);

const submit = () => {
    form.post(route("contact.store"), {
        onSuccess: () => {
            formSubmitted.value = true;
        },
    });
};
</script>
<template>
    <UserLayout :revolving-bar="true">
        <div class="p-6 bg-topback mx-auto my-4 text-center hidden md:block">
            <Header class="mb-4">Get in Touch</Header>
            <div class="flex justify-center gap-40">
                <div class="flex flex-col items-center w-32">
                    <div
                        class="flex items-center justify-center mb-3 border border-solid bg-footer rounded-full w-36 h-36"
                    >
                        <i class="fas fa-envelope text-8xl text-white"></i>
                    </div>
                    <p class="font-roboto text-gray-700">Email</p>
                    <p class="font-roboto text-gray-700">gains@gmail.com</p>
                </div>
                <div class="flex flex-col items-center w-32">
                    <div
                        class="flex items-center justify-center mb-3 border border-solid bg-footer rounded-full w-36 h-36"
                    >
                        <i class="fas fa-phone text-8xl text-white"></i>
                    </div>
                    <p class="font-roboto text-gray-700">Phone</p>
                    <p class="font-roboto text-gray-700">01332 345475</p>
                </div>
                <div class="flex flex-col items-center w-32">
                    <div
                        class="flex items-center justify-center mb-3 border border-solid bg-footer rounded-full w-36 h-36"
                    >
                        <i class="fas fa-location-dot text-8xl text-white"></i>
                    </div>
                    <p class="font-roboto text-gray-700">Address</p>
                    <p class="font-roboto text-gray-700">
                        64 Striker Lane, Kensington, London, W8 4AB
                    </p>
                </div>
            </div>
            <p class="font-montserrat font-semibold text-black mt-6">
                For inquiries, please use the form below.
            </p>
        </div>
        <form
            v-if="!formSubmitted"
            @submit.prevent="submit"
            class="w-full md:w-6/12 p-6 bg-white rounded-lg mx-auto my-4"
        >
            <Header class="mb-4">Contact Us</Header>

            <!-- Name Section -->
            <div class="mb-4">
                <InputLabel for="name" :value="'Name:'" />
                <input
                    id="name"
                    v-model="form.name"
                    type="text"
                    required
                    class="mt-1 font-roboto w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-black focus:border-black"
                />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>
            <!-- Email Section -->
            <div class="mb-4">
                <InputLabel for="email" :value="'Email:'" />
                <input
                    id="email"
                    v-model="form.email"
                    type="email"
                    required
                    class="mt-1 font-roboto w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-black focus:border-black"
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>
            <!-- Subject Section -->
            <div class="mb-4">
                <InputLabel for="subject" :value="'Subject:'" />

                <input
                    id="subject"
                    v-model="form.subject"
                    type="text"
                    maxlength="100"
                    required
                    class="mt-1 font-roboto w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-black focus:border-black"
                />
                <InputError class="mt-2" :message="form.errors.subject" />
            </div>

            <div class="mb-4">
                <InputLabel
                    for="category"
                    class="font-roboto text-sm font-medium text-midgrey"
                    :value="'Category:'"
                />

                <select
                    id="category"
                    v-model="form.category"
                    required
                    class="mt-1 font-roboto w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-black focus:border-black"
                >
                    <option disabled value="">Please select one</option>
                    <option value="technical_support">Technical Support</option>
                    <option value="billing">Billing and Payments</option>
                    <option value="general_inquiry">General Inquiry</option>
                </select>
                <InputError class="mt-2" :message="form.errors.category" />
            </div>

            <!-- query Section -->
            <div class="mb-4">
                <InputLabel for="query" :value="'Message:'" />

                <textarea
                    id="query"
                    v-model="form.query"
                    required
                    class="mt-1 font-roboto w-full px-3 py-2 min-h-32 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-black focus:border-black"
                ></textarea>
                <InputError class="mt-2" :message="form.errors.query" />
            </div>
            <!-- Submit Button -->
            <PrimaryButton
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Submit
            </PrimaryButton>
        </form>
        <div
            v-else
            class="w-full md:w-6/12 p-6 bg-white rounded-lg mx-auto my-4"
        >
            Yay
        </div>
    </UserLayout>
</template>
