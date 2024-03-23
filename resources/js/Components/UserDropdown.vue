<script setup>
import { ref } from "vue";
import NavLink from "./NavLink.vue";

const menuVisible = ref(false);

const props = defineProps({
    user: {
        type: Object,
    },
});
</script>

<template>
    <div
        class="relative flex items-center"
        @mouseover="() => (menuVisible = true)"
        @mouseleave="() => (menuVisible = false)"
    >
        <NavLink v-if="user" class="cursor-pointer px-5 h-full" href="/profile">
            <i class="bi bi-person text-xl"></i>
        </NavLink>
        <NavLink v-else class="cursor-pointer px-5 h-full" href="/login">
            <i class="bi bi-person text-xl"></i>
        </NavLink>

        <div
            v-if="user"
            class="menu-wrapper absolute top-20 left-0 w-48 bg-white border-b border-s border-r border-gray-300 p-2 opacity-0"
            :class="{ 'menu-visible': menuVisible }"
        >
            <ul class="list-none m-0 p-0">
                <li class="mb-2 flex">
                    <NavLink href="/profile">
                        <i class="bi bi-person text-xl me-3"></i>My
                        Account</NavLink
                    >
                </li>
                <li class="mb-2 flex">
                    <NavLink href="/orders">
                        <i class="bi bi-box-seam text-xl me-3"></i>My
                        Orders</NavLink
                    >
                </li>
                <li class="mb-2 flex">
                    <NavLink href="/logout" method="post"
                        ><i class="bi bi-box-arrow-right text-xl me-3"></i
                        >Logout</NavLink
                    >
                </li>
            </ul>
        </div>
    </div>
</template>

<style scoped>
.menu-wrapper {
    transition: opacity 1s, transform 1s;
    transform: translateY(-10px);
}

.menu-visible {
    opacity: 1;
    transform: translateY(0);
}
</style>
