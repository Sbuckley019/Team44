<script setup>
import UserLayout from "@/Layouts/UserLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>
<template>
    <Head title="About" />
    <UserLayout>
        <div>
            <section class="py-12 bg-gray-200">
                <div class="w-4/5 mx-auto flex-1">
                    <h1>About Gains</h1>
                    <p>
                        Gains is a leading e-commerce platform dedicated to
                        fitness enthusiasts, offering premium gym equipment,
                        clothing, and accessories. Our mission is to provide a
                        smooth shopping experience supported by an extensive
                        inventory control system for effective order
                        fulfillment.
                    </p>
                </div>
            </section>

            <section class="py-12">
                <div class="w-4/5 mx-auto flex-1">
                    <h1>Our Mission</h1>
                    <p>
                        Our mission is to empower individuals in their fitness
                        journey by providing top-quality products that cater to
                        all ages and fitness levels. Whether you're just
                        starting out or a seasoned athlete, we are committed to
                        supporting your training and workout needs.
                    </p>
                </div>
            </section>

            <section class="py-12 bg-gray-300">
                <div class="w-4/5 mx-auto flex-1">
                    <h1>What We Offer</h1>
                    <p>
                        We offer a wide selection of fitness products, from
                        state-of-the-art gym equipment to stylish and functional
                        workout apparel. Our user-friendly website and robust
                        inventory system ensure you have access to the latest
                        and most effective fitness tools on the market.
                    </p>
                </div>
            </section>
        </div>
    </UserLayout>
</template>
