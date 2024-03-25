<script setup>
import { ref } from "vue";
import Slideshow from "@/Components/Slideshow.vue";

const image_url = ref("/images/AuthSidebar.jpg");
</script>

<template>
    <div class="flex min-h-screen bg-white dark:bg-black">
        <div
            id="background"
            class="fixed top-0 left-0 w-6/12 h-screen bg-cover bg-center hidden lg:flex"
            :style="{ backgroundImage: 'url(' + image_url + ')' }"
        >
            <Slideshow />
        </div>

        <div class="w-full mx-auto lg:w-6/12 lg:ml-auto lg:mr-0">
            <div
                id="form"
                class="flex justify-center items-center bg-white dark:bg-black"
            >
                <div class="w-full h-full sm:max-w-md px-4 lg:px-8 py-16">
                    <slot />
                </div>
            </div>
        </div>
    </div>
</template>
