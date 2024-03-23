<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import Header from "@/Components/Header.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/PrimaryButton.vue";
import { useForm } from "@inertiajs/vue3";
import { useCheckoutStore } from "@/stores/checkout.js";

const store = useCheckoutStore();

const form = useForm({
    card_number: store.form.paymentDetails.card_number,
    expiry_date: store.form.paymentDetails.expiry_date,
    cvv: store.form.paymentDetails.card_cvv,
});

const emit = defineEmits(["checkout", "change"]);

const goToShipping = () => {
    emit("change", "shipping");
};

const submit = () => {
    form.post(route("checkout.payment"), {
        onSuccess: () => {
            store.updatePaymentDetails(form.data());
            emit("checkout");
        },
    });
};
</script>
<template>
    <form @submit.prevent="submit" class="h-96">
        <Header>Payment Method</Header>
        <div class="mb-4">
            <InputLabel value="Card Number:" />
            <TextInput
                id="card_number"
                v-model="form.card_number"
                type="text"
                required
                autofocus
                autocomplete="card_number"
            />
            <InputError :message="form.errors.card_number" class="mb-2" />
        </div>
        <div class="mb-4">
            <InputLabel value="Expiry Date (MM/YY):" />
            <TextInput
                id="expiry_date"
                v-model="form.expiry_date"
                type="text"
                required
                autofocus
                autocomplete="expiry_date"
            />
            <InputError :message="form.errors.expiry_date" class="mb-2" />
        </div>
        <div class="mb-4">
            <InputLabel value="CVV:" />
            <TextInput
                id="cvv"
                v-model="form.cvv"
                type="text"
                required
                autofocus
                autocomplete="cvv"
            />
            <InputError :message="form.errors.cvv" class="mb-2" />
        </div>
    </form>
    <div class="flex">
        <PrimaryButton @click="goToShipping"
            >< Return to Shipping</PrimaryButton
        >
        <PrimaryButton @click="submit">Checkout</PrimaryButton>
    </div>
</template>
