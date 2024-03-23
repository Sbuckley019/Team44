<script setup>
import UserLayout from "@/Layouts/UserLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import NavLink from "@/Components/NavLink.vue";
import { router, usePage } from "@inertiajs/vue3";
import { ref } from "vue";




const { url } = usePage();

const loginUrl = ref(`/login?intended=${encodeURIComponent(url)}`);

</script>
<template>
    <UserLayout> <div>
                    <Header class="text-center">Log in to view favourites</Header>
                    <img src="../../../public/images/Favourites.png" alt="Empty Basket Image" class="mx-auto mb-4 w-96" />
                    <div class="md:px-24"><PrimaryButton >
                    <NavLink :href="loginUrl">Catapult</NavLink></PrimaryButton></div>
            </div></UserLayout>
</template>
