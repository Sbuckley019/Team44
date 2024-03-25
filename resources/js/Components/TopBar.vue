<script setup>
import TopLink from "@/Components/TopLink.vue";
import { defineProps, ref } from "vue";

const props = defineProps({
    user: {
        type: Object,
        required: false,
    },
});
const isDarkMode = ref(false);

function toggleDarkMode() {
    isDarkMode.value = !isDarkMode.value;
    if (isDarkMode.value) {
        document.documentElement.classList.add("dark");
    } else {
        document.documentElement.classList.remove("dark");
    }
}
</script>
<template>
    <div class="bg-topback dark:bg-black h-8 hidden sm:block">
        <ul class="flex flex-row justify-end h-full me-7">
            <button
                @click="toggleDarkMode"
                class="text-black dark:text-white dark:text-white text-sm"
            >
                <i class="fa-regular fa-circle-dot"></i>
            </button>
            <li
                class="flex border-solid border-topbord text-topbord dark:text-whitetext dark:text-white border-r items-center px-2.5 hover:text-black dark:text-white"
            >
                <i class="bi bi-person text-sm"></i>

                <div v-if="user">
                    <TopLink
                        href="/profile"
                        class="block py-3 px-2.5 no-underline font-bold cursor-default leading-10 my-0 text-sm"
                    >
                        Hi, {{ user.username }}
                    </TopLink>
                </div>
                <div v-else>
                    <TopLink href="/login" class="leading-10 my-0 text-sm">
                        Account
                    </TopLink>
                </div>
            </li>
            <li
                class="flex border-solid border-topbord text-topbord dark:text-whitetext border-r items-center px-2.5"
            >
                <TopLink href="/about" class="leading-10 my-0 text-sm"
                    >About Us</TopLink
                >
            </li>
            <li
                class="flex border-solid border-topbord text-topbord dark:text-whitetext border-r items-center px-2.5"
            >
                <TopLink href="/feedback" class="leading-10 my-0 text-sm"
                    >Feedback</TopLink
                >
            </li>
            <li
                class="flex border-solid border-topbord text-topbord dark:text-whitetext items-center px-2.5"
            >
                <TopLink href="/contact" class="leading-10 my-0 text-sm"
                    >Contact Us</TopLink
                >
            </li>
        </ul>
    </div>
</template>
