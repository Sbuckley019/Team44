import { defineStore } from "pinia";
import { ref } from "vue";

export const useCheckoutStore = defineStore("checkout", () => {
    const form = ref({
        shippingDetails: {
            first_name: "",
            last_name: "",
            email: "",
            address: "",
            shipping_method: "",
        },
        paymentDetails: {
            card_number: "",
            expiry_date: "",
            cvv: "",
        },
    });

    const shippingCosts = {
        free: 0,
        next_day: 13.99,
    };

    const updateShippingDetails = (details) => {
        form.value.shippingDetails = {
            ...form.value.shippingDetails,
            ...details,
        };
    };
    const updatePaymentDetails = (details) => {
        form.value.paymentDetails = {
            ...form.value.paymentDetails,
            ...details,
        };
    };

    const getShippingCost = () => {
        return (
            shippingCosts[form.value.shippingDetails.shipping_method] || null
        );
    };

    const resetCheckout = () => {
        form.value.shippingDetails = {
            first_name: "",
            last_name: "",
            email: "",
            address: "",
            shipping_method: "",
        };
        form.value.paymentDetails = {
            card_number: "",
            expiry_date: "",
            cvv: "",
        };
    };

    return {
        form,
        updateShippingDetails,
        updatePaymentDetails,
        getShippingCost,
        resetCheckout,
    };
});
