<script setup>
import { ref, computed } from "vue";
import { useBasketStore } from "@/stores/basket";
import UserLayout from "@/Layouts/UserLayout.vue";
import Header from "@/Components/Header.vue";
import BasketCard from "@/Components/BasketCard.vue";
import Summary from "@/Components/Summary.vue";
import { router } from "@inertiajs/vue3";

const store = useBasketStore();

const basket = computed(() => store.items);

const totalPrice = computed(() => store.calculateTotalPrice());

const checkout = () => {
    router.visit(route("checkout"));
};
</script>
<template>
    <UserLayout>
        <div class="md:flex pt-10">
            <div  id="bag" class="w-full p-10">
                <Header class="text-start text-xl" >Your bag</Header>
                <div v-if="Object.keys(basket).length >0">
                    <BasketCard
                        v-for="[key, product] in Object.entries(basket)"
                        :key="key"
                        :product="product"
                    /></div>
                    <div v-else>
                    <Header class="text-center">Your bag is empty :(</Header>
                    <img src="../../../public/images/empty-cart-guy.png" alt="Empty Basket Image" class="mx-auto mb-4 w-96" />
                    <div class="md:px-24"><PrimaryButton @click="goToProducts">continue shopping</PrimaryButton></div>
            </div>
            </div>
            <Summary
                @is-clicked="checkout"
                :total="totalPrice"
                :isCheckout="false"
            />
        </div>
    </UserLayout>
</template>
