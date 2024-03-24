<script setup>
import { ref, computed } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import NavLink from "@/Components/NavLink.vue";
import TopBar from "@/Components/TopBar.vue";
import Burger from "@/Components/Burger.vue";
import BurgerMenu from "@/Components/BurgerMenu.vue";
import SearchModal from "@/Components/SearchModal.vue";
import TextInput from "@/Components/TextInput.vue";
import UserDropdown from "@/Components/UserDropdown.vue";
import SearchBar from "@/Components/SearchBar.vue";
import { useBasketStore } from "@/stores/basket.js";
import { usePersistBasket } from "@/Composables/PersistBasket.js";

usePersistBasket();

const store = useBasketStore();

const { props } = usePage();

const user = computed(() => props.auth.user).value;
const isAdmin = computed(() => props.auth.isAdmin).value;

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
        <TopBar :user="user" />
        <nav class="bg-white border-y border-greyt">
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex h-20">
                    <div class="flex w-full justify-between">
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
                        </div>
                        <div class="flex flex-row items-center">
                            <button
                                @click="toggleSearch"
                                class="hover:border-b-2 hover:border-gray-300 px-2 sm:px-5 h-full"
                            >
                                <i class="bi bi-search text-lg"></i>
                            </button>
                            <NavLink
                                v-if="isAdmin"
                                href="/dashboard"
                                class="px-2 sm:px-5 h-full"
                            >
                                <i class="bi bi-briefcase text-xl"></i>
                            </NavLink>
                            <UserDropdown :user="user" class="h-full" />

                            <NavLink
                                href="/favourites"
                                class="px-2 sm:px-5 h-full"
                            >
                                <i class="bi bi-heart text-lg"></i>
                            </NavLink>
                            <NavLink href="/basket" class="px-2 sm:px-5 h-full">
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
    <SearchModal :show="search" @close="toggleSearch">
        <SearchBar />
    </SearchModal>
</template>
