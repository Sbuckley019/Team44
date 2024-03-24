<script setup>
import AdminHeader from "@/Components/AdminHeader.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import Header from "@/Components/Header.vue";
import NavLink from "@/Components/NavLink.vue";

const logout = () => {
    //route('admin.logout')
    //{{ route('admin.dashboard') }}
    //{{route('feedback.index')}}
};
</script>
<template>
    <div
        class="flex h-20 items-center bg-white px-4 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 md:px-6 lg:px-8"
    >
        <ApplicationLogo class="w-16" />
    </div>
    <div class="flex">
        <aside
            class="fi-sidebar-nav flex flex-col gap-y-4 overflow-y-auto overflow-x-hidden px-6 py-8 w-68 border-r"
        >
            <AdminHeader :value="'Dashboard'"
                ><i class="bi bi-house text-2xl"></i
            ></AdminHeader>
            <div>
                <AdminHeader
                    :value="'Operations'"
                    class="hover:bg-inherit cursor-default"
                />
                <AdminHeader :value="'Products'" :href="route('admin.items')">
                    <i class="bi bi-boxes text-2xl"></i
                ></AdminHeader>
                <AdminHeader :value="'Orders'" :href="route('admin.orders')">
                    <i class="bi bi-bag text-2xl"></i
                ></AdminHeader>
                <AdminHeader
                    :value="'Customers'"
                    :href="route('admin.customers')"
                    ><i class="bi bi-people text-2xl"></i
                ></AdminHeader>
            </div>
            <div>
                <AdminHeader
                    :value="'Communications'"
                    class="cursor-default hover:bg-inherit"
                />
                <AdminHeader :value="'Feedback'"
                    ><i class="bi bi-clipboard text-2xl"></i
                ></AdminHeader>
                <AdminHeader :value="'Contact Requests'"
                    ><i class="bi bi-chat text-2xl"></i
                ></AdminHeader>
            </div>

            <NavLink
                class="logoutButton"
                href="/logout"
                method="post"
                as="button"
                >Logout</NavLink
            >
        </aside>

        <main class="p-8 flex-1">
            <slot />
        </main>
    </div>
</template>
