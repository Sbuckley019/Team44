<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import { ref, computed } from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Header from "@/Components/Header.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import UserLayout from "@/Layouts/UserLayout.vue";
import ProductCard from "@/Components/ProductCard.vue";
const reviewProps = defineProps({
    product: {
        type: Object,
    },
    review: {
        type: Object,
    },
});

const reviewData = reviewProps.review || {
    review_heading: "",
    review_text: "",
    rating: "",
};

const { props } = usePage();

const form = useForm({
    user_id: props.auth.user.id,
    product_id: reviewProps.product.id,
    review_heading: reviewData.review_heading,
    rating: reviewData.rating,
    review_text: reviewData.review_text,
});

const formSubmitted = ref(false);

const routeName = computed(() => {
    return reviewProps.review ? "review.update" : "review.store";
});

const routeParams = computed(() => {
    return reviewProps.review ? { reviewId: reviewProps.review.id } : {};
});

function submit() {
    form.patch(route(routeName.value, routeParams.value), {
        onSuccess: () => {
            formSubmitted.value = true;
        },
        onError: (error) => {
            console.log(error);
        },
    });
}
</script>
<template>
    <UserLayout>
        <form
            v-if="!formSubmitted"
            @submit.prevent="submit"
            class="w-full md:w-6/12 p-6 bg-white dark:bg-black rounded-lg mx-auto my-4"
        >
            <Header class="mb-4">Review This Product</Header>
            <div
                class="flex flex-col items-center p-2 border-2 mb-3 rounded-md"
            >
                <img
                    :src="product.image_url"
                    class="min-w-40 min-w-40 max-w-60 max-h-60"
                />
                <Header class="text-sm font-semibold font-roboto">{{
                    product.product_name
                }}</Header>
            </div>
            <div class="mb-4 text-center">
                <InputLabel
                    for="rating"
                    :value="'What is your rating of this product'"
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
                            <span v-else class="dark:text-white text-gray-300"
                                >&#9733;</span
                            >
                        </span>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <InputLabel for="review_heading" :value="'Review Heading:'" />
                <input
                    id="review_heading"
                    v-model="form.review_heading"
                    type="review_heading"
                    required
                    class="mt-1 font-roboto w-full px-3 py-2 bg-white dark:bg-black border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-black dark:ring-white dark:focus:ring-white focus:border-black"
                />
                <InputError
                    class="mt-2"
                    :message="form.errors.review_heading"
                />
            </div>
            <div class="mb-4">
                <InputLabel
                    for="feedback"
                    :value="'Please leave your review below:'"
                />

                <textarea
                    id="review_text"
                    v-model="form.review_text"
                    required
                    class="mt-1 font-roboto w-full px-3 py-2 min-h-32 bg-white dark:bg-black border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-black dark:ring-white focus:border-black"
                ></textarea>
                <InputError class="mt-2" :message="form.errors.review_text" />
            </div>
            <PrimaryButton
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Submit
            </PrimaryButton>
        </form>
    </UserLayout>
</template>
