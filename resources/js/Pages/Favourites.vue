<script setup>
import UserLayout from "@/Layouts/UserLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import NavLink from "@/Components/NavLink.vue";
import Header from "@/Components/Header.vue";
import { router, usePage } from "@inertiajs/vue3";
import { ref } from "vue";
const props = defineProps({
    loggedIn: {
        type: Boolean,
    },
});

const { url } = usePage();

const loginUrl = ref(`/login?intended=${encodeURIComponent(url)}`);

const goToLogin = () => {
    router.visit(loginUrl.value);
};

const goToProducts = () => {
    router.visit(route("products.index"));
};
</script>
<template>
    <UserLayout>
        <div class="mt-8">
            <Header v-if="loggedIn" class="text-center text-xl"
                >You Currently have no favourites</Header
            >
            <Header v-else class="text-center text-xl"
                >Log in to view favourites</Header
            >

            <img
                src="../../../public/images/Favourites.png"
                alt="Empty Favourites Image"
                class="mx-auto mb-4 w-96"
            />
            <div class="md:px-24 flex justify-center">
                <PrimaryButton
                    v-if="loggedIn"
                    @click="goToProducts"
                    class="w-96"
                    >Shop Products</PrimaryButton
                >
                <PrimaryButton v-else @click="goToLogin" class="w-96"
                    >Go to login</PrimaryButton
                >
            </div>
        </div></UserLayout
    >
</template>
