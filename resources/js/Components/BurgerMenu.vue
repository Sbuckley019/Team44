<template>
    <div>
        <div class="pb-1 border-t border-gray-200">
            <div class="mt-3 space-y-1">
                <ResponsiveNavLink href="/products/1">Mens</ResponsiveNavLink>
                <ResponsiveNavLink href="/products/2">Womens</ResponsiveNavLink>
                <ResponsiveNavLink href="/products/3"
                    >Accessories</ResponsiveNavLink
                >
                <ResponsiveNavLink href="/products/4"
                    >Supplements</ResponsiveNavLink
                >
                <ResponsiveNavLink href="/products/5"
                    >Equipment</ResponsiveNavLink
                >
                <ResponsiveNavLink v-if="user" :href="route('profile.edit')">
                    Profile
                </ResponsiveNavLink>
                <ResponsiveNavLink
                    v-if="user"
                    :href="route('logout')"
                    method="post"
                    as="button"
                >
                    Log Out
                </ResponsiveNavLink>
            </div>
        </div>
    </div>
</template>
<script setup>
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
const props = defineProps({
    user: { type: Object },
});
</script>
