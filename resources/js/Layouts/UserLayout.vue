<script setup>
import NavigationBar from "@/Components/NavigationBar.vue";
import RevolvingBar from "@/Components/RevolvingBar.vue";
import Footer from "@/Components/Footer.vue";
import FlashMessage from "@/Components/FlashMessage.vue";
import SearchModal from "@/Components/SearchModal.vue";
import { useBasketStore } from "@/stores/basket";
import { computed } from "vue";

const store = useBasketStore();
const message = computed(() => store.message);

const props = defineProps({
    revolvingBar: {
        type: Boolean,
    },
});
</script>

<template>
    <div class="min-h-screen bg-white">
        <NavigationBar />
        <RevolvingBar v-if="!revolvingBar" />

        <FlashMessage
            v-if="$page.props.flash.success || message"
            :message="$page.props.flash.success || message"
            color="green"
        />

        <FlashMessage
            v-if="$page.props.flash.error"
            :message="$page.props.flash.error"
            color="red"
        />

        <!-- Page Content -->
        <main class="mb-8">
            <slot />
        </main>

        <Footer />
    </div>
</template>
