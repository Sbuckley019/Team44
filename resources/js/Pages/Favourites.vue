<script setup>
import UserLayout from "@/Layouts/UserLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import NavLink from "@/Components/NavLink.vue";
import Header from "@/Components/Header.vue";
import { router, usePage } from "@inertiajs/vue3";
import { ref } from "vue";




const { url } = usePage();

const loginUrl = ref(`/login?intended=${encodeURIComponent(url)}`);

</script>
<template>
    <UserLayout> <div>
                    <Header class="text-center text-xl " >Log in to view favourites</Header>
                    <img src="../../../public/images/Favourites.png" alt="Empty Favourites Image" class="mx-auto mb-4 w-96" />
                    <div class="md:px-24 flex justify-center"><NavLink class="w-3/5 hover:border-0 active-0 " :href="loginUrl"><PrimaryButton>Go to login</PrimaryButton></NavLink></div>
            </div></UserLayout>
</template>
