<script setup>
import NavigationBar from "@/Components/NavigationBar.vue";
<<<<<<< Updated upstream
import RevolvingBar from "@/Components/RevolvingBar.vue";
=======
>>>>>>> Stashed changes
import Footer from "@/Components/Footer.vue";
import FlashMessage from "@/Components/FlashMessage.vue";
import SearchModal from "@/Components/SearchModal.vue";
import { useBasketStore } from "@/stores/basket";
import { computed } from "vue";

const store = useBasketStore();
const message = computed(() => store.message);

<<<<<<< Updated upstream
const props = defineProps({
    revolvingBar: {
        type: Boolean,
    },
});
=======
>>>>>>> Stashed changes
</script>

<template>
    <div class="min-h-screen bg-white">
        <NavigationBar />
<<<<<<< Updated upstream
        <RevolvingBar v-if="!revolvingBar" />
=======
>>>>>>> Stashed changes

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
