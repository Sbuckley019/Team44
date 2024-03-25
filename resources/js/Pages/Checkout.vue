<script setup>
import { computed, ref } from "vue";
import BasketCard from "@/Components/BasketCard.vue";
import Summary from "@/Components/Summary.vue";
import { useBasketStore } from "@/stores/basket";
import { useCheckoutStore } from "@/stores/checkout";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import PaymentDetails from "../Components/PaymentDetails.vue";
import ShippingDetails from "../Components/ShippingDetails.vue";
import { router } from "@inertiajs/vue3";

const basketStore = useBasketStore();
const basket = computed(() => basketStore.items);
const totalPrice = computed(() => basketStore.calculateTotalPrice());

const checkoutStore = useCheckoutStore();
const shippingCost = computed(() => checkoutStore.getShippingCost()).value;

const stages = ["shipping", "payment"];
const currentStage = ref(stages[0]);

const checkoutStage = computed(() => {
    if (currentStage.value == "shipping") {
        return ShippingDetails;
    } else {
        return PaymentDetails;
    }
});

const changeStage = (stage) => {
    currentStage.value = stage;
};

const checkout = () => {
    router.post(
        route("checkout.submit"),
        {
            basket: basket.value,
            shippingDetails: checkoutStore.form.shippingDetails,
            paymentDetails: checkoutStore.form.paymentDetails,
        },
        {
            onSuccess: () => {
                basketStore.emptyBasket();
                console.log(basket);
                router.visit("/");
            },
            onError: (error) => console.log(error),
        }
    );
};
</script>

<template>
    <div class="lg:flex mb-10">
        <div
            class="w-full lg:w-6/12 px-6 bg-white dark:bg-black rounded-lg mx-auto mt-10"
        >
            <ApplicationLogo class="mx-auto w-40" />
            <component
                :is="checkoutStage"
                @change="changeStage"
                @checkout="checkout"
            />
        </div>

        <div class="w-full lg:w-1/3 px-2">
            <div
                class="mx-auto h-96 border border-2 overflow-y-scroll mt-10 me-4"
            >
                <div
                    v-for="(product, index) in basket"
                    :key="index"
                    class="border-b"
                >
                    <BasketCard
                        :product="product"
                        :isCheckout="true"
                        :customWidth="'w-48'"
                        :customHeight="'h-32'"
                    />
                </div>
            </div>
            <Summary
                :total="totalPrice"
                :shipping="shippingCost"
                :is-checkout="true"
                class="md:px-0 md:w-full"
            />
        </div>
    </div>
</template>
