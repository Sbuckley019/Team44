<script setup>
import Header from "@/Components/Header.vue";
import NavLink from "@/Components/NavLink.vue";

const logout = () => {
    //route('admin.logout')
    //{{ route('admin.dashboard') }}
    //{{ route('products.adminIndex') }}
    //{{ route('order.index') }}
    //{{ route('customer.index') }}
    //{{route('feedback.index')}}
};
</script>
<template>
    <Header> Admin Dashboard </Header>

    <aside class="bg-greyt w-96 fixed top-40 bottom-4 py-4 overflow-y-auto">
        <ul>
            <li>
                <NavLink href="/">Dashboard</NavLink>
            </li>
            <li>
                <NavLink href="/">Products</NavLink>
            </li>
            <li><NavLink href="/">Orders</NavLink></li>
            <li>
                <NavLink href="/">Customers</NavLink>
            </li>
            <li>
                <NavLink href="/">Feedback</NavLink>
            </li>
            <li>
                <button class="logoutButton" @click="logout">Logout</button>
            </li>
        </ul>
    </aside>

    <main class="ms-96 p-8 flex-1">
        <slot />
    </main>
</template>
