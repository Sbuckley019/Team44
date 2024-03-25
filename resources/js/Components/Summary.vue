<script setup>
import { computed } from "vue";
import Header from "@/Components/Header.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const emit = defineEmits(["is-clicked"]);

const handleClick = () => {
    emit("is-clicked");
};

const props = defineProps({
    total: {
        type: Number,
    },
    isCheckout: {
        type: Boolean,
    },
    shipping: {
        type: Number,
    },
});
const shipping = computed(() => props.shipping);
console.log(shipping);
</script>
<template>
    <div class="w-full p-10 md:w-2/6 md:px-4">
        <Header class="text-start text-xl">Summary</Header>
        <hr />
        <div class="px-3">
            <div
                class="flex font-roboto text-base text-midgrey dark:text-white py-3 justify-between"
            >
                <p>Subtotal</p>
                £{{ total }}
            </div>
            <div
                class="font-roboto text-base text-midgrey dark:text-white py-3"
            >
                <div class="flex justify-between" v-if="shipping">
                    <p>Shipping</p>
                    £{{ shipping }}
                </div>
                <div class="flex justify-between" v-else>
                    <p>Sales</p>
                    £250
                </div>
            </div>
            <div
                class="flex font-bold font-roboto text-base py-3 justify-between"
            >
                <p>Total</p>
                <p v-if="shipping">£{{ (total + shipping).toFixed(2) }}</p>
                <p v-else>£{{ (total - 250).toFixed(2) }}</p>
            </div>
        </div>
        <hr />
        <PrimaryButton v-if="!isCheckout" @click="handleClick" class="mt-4">
            Checkout</PrimaryButton
        >
    </div>
</template>
