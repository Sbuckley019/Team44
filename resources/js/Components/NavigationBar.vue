<script setup>
import { ref, computed } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import NavLink from "@/Components/NavLink.vue";
import TopBar from "@/Components/TopBar.vue";
import Burger from "@/Components/Burger.vue";
import BurgerMenu from "@/Components/BurgerMenu.vue";
import SearchModal from "@/Components/SearchModal.vue";
import { useBasketStore } from "@/stores/basket";
import { usePersistBasket } from "@/Composables/PersistBasket.js";

usePersistBasket();

const store = useBasketStore();

const { props } = usePage();

const user = computed(() => props.auth.user).value;

const basket = computed(() => store.items);

const basketSize = computed(() => Object.keys(basket.value).length);

const showingNavigationDropdown = ref(false);

const search = ref(false);

const toggleNavigationDropdown = () => {
    showingNavigationDropdown.value = !showingNavigationDropdown.value;
};

const toggleSearch = () => {
    search.value = !search.value;
};
</script>
<template>
    <div class="z-50 sticky top-0">
        <TopBar :user="user" class="hidden md:block" />
        <nav class="bg-white border-y border-greyt">
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    <div class="flex w-full">
                        <!-- Logo -->
                        <div class="flex items-center">
                            <Link :href="route('home')">
                                <ApplicationLogo
                                    class="block h-9 w-auto fill-current text-gray-800"
                                />
                            </Link>
                        </div>

                        <!-- Navigation Links -->
                        <div
                            class="hidden space-x-8 w-full sm:-my-px sm:ms-10 lg:flex"
                        >
                            <div
                                class="flex flex-row w-full justify-between px-16"
                            >
                                <NavLink href="/products/1">Mens</NavLink>
                                <NavLink href="/products/2">Womens</NavLink>
                                <NavLink href="/products/3"
                                    >Accessories</NavLink
                                >
                                <NavLink href="/products/4"
                                    >Supplements</NavLink
                                >
                                <NavLink href="/products/5">Equipment</NavLink>
                            </div>

                            <div class="flex flex-row justify-end">
                                <div class="flex">
                                    <button @click="toggleSearch" class="px-5">
                                        <i class="bi bi-search text-lg"></i>
                                    </button>
                                    <div v-if="user" class="flex">
                                        <NavLink href="/profile" class="px-5">
                                            <i class="bi bi-person text-xl"></i
                                        ></NavLink>
                                        <div
                                            class="hidden flex flex-col absolute bg-black min-w-40 shadow-lg z-10"
                                        >
                                            <NavLink href="/password/change"
                                                >Change Password</NavLink
                                            >
                                            <a href="#" @click="logout"
                                                >Log out</a
                                            >
                                        </div>
                                    </div>

                                    <div v-else class="flex">
                                        <NavLink href="/login" class="px-5">
                                            <i class="bi bi-person text-xl"></i
                                        ></NavLink>
                                    </div>
                                    <NavLink href="/favourites" class="px-5">
                                        <i class="bi bi-heart text-lg"></i>
                                    </NavLink>
                                    <NavLink href="/basket" class="px-5">
                                        <i class="bi bi-bag text-lg"></i>
                                        <div
                                            v-if="basketSize"
                                            class="flex absolute text-white bg-black rounded-full w-4 h-4 top-14 right-11 text-xxs justify-center items-center"
                                        >
                                            {{ basketSize }}
                                        </div></NavLink
                                    >
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Hamburger -->
                    <Burger
                        :showing="showingNavigationDropdown"
                        @toggle="toggleNavigationDropdown()"
                    />
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <BurgerMenu v-if="showingNavigationDropdown" :user="user" />
        </nav>
    </div>
    <SearchModal :show="search" @close="toggleSearch">Hello</SearchModal>
</template>