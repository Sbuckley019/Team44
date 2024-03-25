<script setup>
import { router, usePage } from "@inertiajs/vue3";
import Pagination from "./Pagination.vue";
import { onUnmounted, computed } from "vue";
import ReviewButton from "./ReviewButton.vue";
import SecondaryButton from "./SecondaryButton.vue";

const { props } = usePage();

const userId = computed(() => props.auth.user).value.id;

const reviewProps = defineProps({
    reviews: {
        type: Object,
    },
    canReview: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(["scroll"]);

const handlePageChange = (url) => {
    router.visit(url, {
        preserveScroll: true,
    });
};

const markAsHelpful = (review) => {
    router.post(
        route("review.helpful", { reviewId: review }),
        {},
        {
            preserveScroll: true,
            preserveState: true,
        }
    );
};

const editReview = () => {
    router.visit(route("review.edit"));
};

onUnmounted(() => {
    emit("scroll");
});
</script>

<template>
    <div>
        <div class="copacity-50">
            <template v-if="reviews">
                <div
                    v-for="review in reviews.data"
                    :key="review.id"
                    class="px-12 py-6"
                >
                    <div class="review-user">
                        {{ review.user.username }}
                    </div>
                    <div class="block md:flex my-1">
                        <div
                            class="stars me-1"
                            :style="{
                                '--rating': (review.rating / 5) * 100 + '%',
                            }"
                        ></div>
                        <div
                            class="mt-2 md:mt-0 font-bold font-montserrat text-sm"
                        >
                            {{ review.review_heading }}
                        </div>
                    </div>
                    <div
                        class="text-black dark:text-white font-bold font-montserrat text-xs"
                    >
                        Verified Purchase
                    </div>
                    <div class="text-midgrey dark:text-white text-xs my-0.5">
                        Reviewed on {{ review.created_at }}
                    </div>
                    <div class="font-roboto text-sm text-black dark:text-white">
                        {{ review.review_text }}
                    </div>
                    <div
                        v-if="review.helpfulness > 0"
                        class="mt-2 text-xs text-midgrey dark:text-white"
                    >
                        {{
                            review.helpfulness === 1
                                ? "One person found this helpful"
                                : review.helpfulness +
                                  " people found this helpful"
                        }}
                    </div>
                    <div class="flex">
                        <SecondaryButton
                            v-if="review.user_id == userId"
                            class="mt-3"
                            @click="editReview"
                            >Edit Review</SecondaryButton
                        >
                        <ReviewButton
                            v-else
                            @marked="markAsHelpful(review.id)"
                        />
                    </div>
                </div>
                <div class="ml-12">
                    <div>
                        <div :data="reviews"></div>
                        <Pagination
                            :links="reviews.links"
                            @page-changed="handlePageChange"
                        ></Pagination>
                    </div>
                </div>
            </template>
            <template v-else>
                There are currently no reviews for this product
            </template>
        </div>
    </div>
</template>
<style>
.stars {
    background: url("../../images/star-empty.png");
    background-size: contain;
    width: 100px;
    height: 20px;
}
.stars::before {
    content: "";
    display: block;
    background: url("../../images/star-full.png");
    background-size: contain;
    width: var(--rating);
    height: 100%;
    transition: width 0.3s;
}
</style>
