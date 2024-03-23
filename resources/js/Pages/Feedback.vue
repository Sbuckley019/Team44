<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Header from "@/Components/Header.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import UserLayout from "@/Layouts/UserLayout.vue";

const form = useForm({
    rating: "",
    name: "",
    email: "",
    feedback: "",
});

const formSubmitted = ref(false);

function submit() {
    form.post(route("feedback.store"), {
        onSuccess: () => {
            formSubmitted.value = true;
        },
    });
}
</script>
<template>
    <UserLayout>
        <form
            v-if="!formSubmitted"
            @submit.prevent="submit"
            class="w-full md:w-6/12 p-6 bg-white rounded-lg mx-auto my-4"
        >
            <Header class="mb-4">Feedback form</Header>
            <!-- Rating Section -->
            <div class="mb-4 text-center">
                <InputLabel
                    for="rating"
                    :value="'What is your rating of our website?'"
                />
                <div class="flex space-x-1 justify-center">
                    <div v-for="star in 5">
                        <span
                            :key="star"
                            class="cursor-pointer text-6xl"
                            @click="form.rating = star"
                        >
                            <span v-if="form.rating >= star" class="text-yellow"
                                >&#9733;</span
                            >
                            <span v-else class="text-gray-300">&#9733;</span>
                        </span>
                    </div>
                </div>
            </div>

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

            <!-- Feedback Section -->
            <div class="mb-4">
                <InputLabel
                    for="feedback"
                    :value="'Please leave your feedback below:'"
                />

                <textarea
                    id="feedback"
                    v-model="form.feedback"
                    required
                    class="mt-1 font-roboto w-full px-3 py-2 min-h-32 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-black focus:border-black"
                ></textarea>
                <InputError class="mt-2" :message="form.errors.feedback" />
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
