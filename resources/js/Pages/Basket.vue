<script setup>
import { ref, computed } from "vue";
import { useBasketStore } from "@/stores/basket";
import UserLayout from "@/Layouts/UserLayout.vue";
import Header from "@/Components/Header.vue";
import BasketCard from "@/Components/BasketCard.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const store = useBasketStore();

const basket = computed(() => store.items);

const totalPrice = computed(() => store.calculateTotalPrice());
</script>
<template>
    <UserLayout revolving-bar="true">
        <div class="md:flex pt-10">
            <div id="bag" class="w-full p-10">
                <Header class="text-start text-xl">Your bag</Header>
                <div v-if="basket">
                    <BasketCard
                        v-for="[key, product] in Object.entries(basket)"
                        :key="key"
                        :product="product"
                    />
                </div>
            </div>
            <div id="summary" class="w-full p-10 md:w-2/6 md:px-4">
                <Header class="text-start text-xl">Summary</Header>
                <hr />
                <div class="px-3">
                    <div
                        class="flex font-roboto text-base text-midgrey py-3 justify-between"
                    >
                        <p>Subtotal</p>
                        £{{ totalPrice }}
                    </div>
                    <div
                        class="flex font-roboto text-base text-midgrey py-3 justify-between"
                    >
                        <p>Sales</p>
                        £250
                    </div>
                    <div
                        class="flex font-bold font-roboto text-base py-3 justify-between"
                    >
                        <p>Total</p>
                        £{{ totalPrice + 250 }}
                    </div>
                </div>
                <hr />
                <PrimaryButton class="mt-4"> Checkout</PrimaryButton>
            </div>
        </div>
    </UserLayout>
</template>
