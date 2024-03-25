<script setup>
import { router } from "@inertiajs/vue3";
import { watch, ref, computed } from "vue";
import { debounce } from "lodash";
import Header from "./Header.vue";
import NavLink from "./NavLink.vue";
import { useSearchStore } from "@/stores/search.js";
const store = useSearchStore();

const recentSearches = computed(() => store.searches);
const searchInput = ref("");
const searchResults = ref([]);
const noResults = ref(false);
const loading = ref(true);
const open = ref(false);

const debouncedSearch = debounce(async (newValue) => {
    if (newValue.length > 0) {
        loading.value = true;
        noResults.value = false;
        try {
            const response = await axios.get(
                route("products.search", { searchInput: newValue })
            );
            searchResults.value = response.data.searchResult;
            noResults.value = response.data.searchResult.length === 0;
        } catch (error) {
            searchResults.value = [];
            noResults.value = true;
        } finally {
            loading.value = false;
        }
    } else {
        searchResults.value = [];
        noResults.value = false;
    }
}, 300);

watch(searchInput, (newValue) => {
    loading.value = true;
    debouncedSearch(newValue);
});

const search = () => {
    store.addSearch(searchInput.value);
    router.get(route("products.index"), { searchTerm: searchInput.value });
};

const openSearch = () => {
    open.value = true;
};
const closeSearch = () => {
    open.value = false;
};

const emit = defineEmits(["close"]);

const closeModal = () => {
    emit("close");
};
</script>
<template>
    <div class="relative flex center mx-auto w-full sm:w-96 mt-4 lg:mt-0">
        <i
            @click="search"
            class="bi bi-search text-lg absolute right-4 top-3 cursor-pointer"
        ></i>
        <input
            class="mt-1 font-roboto w-full px-3 py-2 bg-white dark:bg-black border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-black dark:ring-white focus:border-black"
            placeholder="Search for Products"
            maxlength="20"
            v-model="searchInput"
            @focusin="openSearch"
            @focusout="closeSearch"
            @keyup.enter="search"
        />
    </div>
    <i
        @click="closeModal"
        class="fa-solid fa-x text-2xl top-4 right-8 my-auto absolute cursor-pointer"
    ></i>
    <transition name="slide" mode="out-in">
        <div
            class="lg:flex w-full absolute -z-20 top-16 h-60 bg-white dark:bg-black justify-around lg:border-t-2"
            v-if="open"
        >
            <div id="search History" class="mt-4 max-w-60 overflow-hidden">
                <Header class="text-start">Recent Searches</Header>
                <NavLink
                    class="my-1 w-full"
                    v-for="search in recentSearches"
                    :href="route('products.index', { searchTerm: search })"
                    @click="oldSearch(search)"
                >
                    <i class="bi bi-search text-lg me-2"></i>
                    {{ search }}
                </NavLink>
            </div>
            <div id="Products" class="flex flex-col mt-4 w-8/12">
                <div v-if="!loading">
                    <Header class="text-start">Search Results</Header>
                    <div class="grid lg:grid-rows-3 lg:grid-cols-2 grid-cols-1">
                        <NavLink
                            class="my-1"
                            v-for="product in searchResults"
                            :href="
                                route('product.show', { product_name: product })
                            "
                        >
                            <i class="bi bi-search text-lg me-2"></i>
                            {{ product }}
                        </NavLink>
                    </div>
                    <Header v-if="noResults" class="text-start"
                        >Sorry, No Products Match Your Search :(</Header
                    >
                </div>

                <div
                    v-else-if="searchInput.length > 0"
                    class="w-8 h-8 border-4 border-t-white border-b-white border-l-white border-r-transparent rounded-full animate-spin m-auto"
                ></div>
            </div>
        </div>
    </transition>
</template>
<style scoped>
.slide-enter-active,
.slide-leave-active {
    transition: transform 0.5s ease;
}
.slide-enter-from,
.slide-leave-to {
    transform: translateX(-100%);
}
</style>
