<script setup>
import TopLink from "@/Components/TopLink.vue";
import { defineProps } from "vue";

const props = defineProps({
    user: {
        type: Object,
        required: false,
    },
});
</script>
<template>
    <div class="bg-topback h-8">
        <ul class="flex flex-row justify-end h-full me-7">
            <li
                class="flex border-solid border-topbord text-toptext border-r items-center px-2.5 hover:text-black"
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
                class="flex border-solid border-topbord text-toptext border-r items-center px-2.5"
            >
                <TopLink href="/about" class="leading-10 my-0 text-sm"
                    >About Us</TopLink
                >
            </li>
            <li
                class="flex border-solid border-topbord text-toptext border-r items-center px-2.5"
            >
                <TopLink href="/feedback" class="leading-10 my-0 text-sm"
                    >Feedback</TopLink
                >
            </li>
            <li
                class="flex border-solid border-topbord text-toptext items-center px-2.5"
            >
                <TopLink href="/contact" class="leading-10 my-0 text-sm"
                    >Contact Us</TopLink
                >
            </li>
        </ul>
    </div>
</template>
