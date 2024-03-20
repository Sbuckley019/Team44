import { onUnmounted } from "vue";
import { useBasketStore } from "@/stores/basket.js";

export function usePersistBasket() {
    const BasketStore = useBasketStore();

    const unsub = BasketStore.$subscribe(() => {
        localStorage.setItem("basketItems", JSON.stringify(BasketStore.items));
    });

    onUnmounted(() => {
        unsub();
    });
}
