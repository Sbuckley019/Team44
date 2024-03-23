<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import { ref, computed } from "vue";
import NavLink from "@/Components/NavLink.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import Header from "@/Components/Header.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { useCheckoutStore } from "@/stores/checkout.js";

const store = useCheckoutStore();

const user = computed(() => usePage().props.auth.user).value;

const form = useForm({
    first_name: store.form.shippingDetails.first_name,
    last_name: store.form.shippingDetails.last_name,
    email: user?.email ?? store.form.shippingDetails.email,
    address: store.form.shippingDetails.address,
    shipping_method: store.form.shippingDetails.shippingMethod,
});

const emit = defineEmits(["change"]);

const submit = () => {
    form.post(route("checkout.shipping"), {
        onSuccess: () => {
            store.updateShippingDetails(form.data());
            emit("change", "payment");
        },
    });
};

const { url } = usePage();
const loginUrl = ref(`/login?intended=${encodeURIComponent(url)}`);
</script>
<template>
    <form @submit.prevent="submit">
        <div>
            <div v-if="user">
                <Header>Checkout as {{ user.email }}</Header>
                <p
                    class="font-roboto text-sm font-medium text-midgrey text-center"
                >
                    Not You?
                    <NavLink :href="'/logout'"  method="post">Logout</NavLink>
                </p>
                <hr />
            </div>
            <div v-else class="mb-4">
                <Header>Checkout as Guest</Header>
                <InputLabel value="Email:" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    required
                    autofocus
                    autocomplete="email"
                />
                <InputError :message="form.errors.email" />
                <p class="font-roboto text-sm font-medium text-midgrey">
                    Checkout as User?
                    <NavLink :href="loginUrl">Log In</NavLink>
                </p>
            </div>
        </div>
        <Header>Shipping Address</Header>

        <div class="mb-4">
            <InputLabel value="First Name:" />
            <TextInput
                id="first_name"
                v-model="form.first_name"
                type="text"
                required
                autofocus
                autocomplete="first_name"
            />
            <InputError :message="form.errors.first_name" class="mb-2" />
        </div>
        <div class="mb-4">
            <InputLabel value="Last Name:" />
            <TextInput
                id="last_name"
                v-model="form.last_name"
                type="text"
                required
                autofocus
                autocomplete="last_name"
            />
            <InputError :message="form.errors.last_name" class="mb-2" />
        </div>
        <div class="mb-4">
            <InputLabel value="Address:" />
            <TextInput
                id="address"
                v-model="form.address"
                type="text"
                required
                autofocus
                autocomplete="address"
            />

            <InputError :message="form.errors.address" class="mb-2" />
        </div>
        <div>
            <Header>Shipping method</Header>
            <div class="mb-2">
                <input
                    id="free_delivery"
                    type="radio"
                    v-model="form.shipping_method"
                    value="free"
                />
                <InputLabel
                    value="Free delivery (2-5 working days) £0.00"
                    class="ms-2"
                />
            </div>
            <div class="mb-2">
                <input
                    id="next_day_delivery"
                    type="radio"
                    v-model="form.shipping_method"
                    value="next_day"
                />
                <InputLabel value="Next day delivery £13.99" class="ms-2" />
            </div>
            <InputError :message="form.errors.shipping_method" class="mb-2" />
        </div>
    </form>
    <div class="flex justify-end">
        <PrimaryButton class="lg:m-0 lg:w-6/12" @click="submit"
            >Payment ></PrimaryButton
        >
    </div>
</template>
