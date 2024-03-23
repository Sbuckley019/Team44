<script setup>
import { ref, computed } from "vue";
import { useBasketStore } from "@/stores/basket";
import UserLayout from "@/Layouts/UserLayout.vue";
import Header from "@/Components/Header.vue";
import BasketCard from "@/Components/BasketCard.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { router } from "@inertiajs/vue3";

const store = useBasketStore();

const basket = computed(() => store.items);

const totalPrice = computed(() => store.calculateTotalPrice());

console.log(basket);

const goToProducts = ()=>{
    router.visit(route("products.index"));
}
</script>
<template>
    <UserLayout revolving-bar="true">
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
