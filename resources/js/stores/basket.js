import { defineStore } from "pinia";
import { ref } from "vue";
import { usePersistBasket } from "@/Composables/PersistBasket.js";

export const useBasketStore = defineStore("basket", () => {
    const items = ref(JSON.parse(localStorage.getItem("basketItems")) || {});

    const message = ref(null);

    function addToBasket(productId, value) {
        items.value[productId] = value;
    }

    function addProductsToBasket(products) {
        //Iterate through products (object) storing inside the items.value
    }

    function removeFromBasket(productId) {
        delete items.value[productId];
    }

    function updateMessage(response) {
        message.value = response;
    }

    function numberOfProducts() {
        const quantity = Object.keys(items).length;
        return quantity;
    }
    function calculateTotalPrice() {
        const total = Object.values(items.value).reduce((total, product) => {
            const price = parseFloat(product.price);
            const quantity = product.quantity;
            return total + price * quantity;
        }, 0);

        return parseFloat(total.toFixed(2));
    }

    return {
        items,
        addToBasket,
        removeFromBasket,
        message,
        updateMessage,
        numberOfProducts,
        calculateTotalPrice,
    };
});
