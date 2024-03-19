<script setup>
import { ref } from "vue";

const image_url = ref("/images/Logo.png");
</script>
<template>
    <img :src="image_url" alt="Gains Logo" />
</template>
