import { defineStore } from "pinia";
import { ref } from "vue";

export const useSearchStore = defineStore("searches", () => {
    const searches = ref(JSON.parse(localStorage.getItem("searches")) || []);
    const addSearch = (query) => {
        console.log(searches.value);
        if (!searches.value.includes(query)) {
            if (searches.value.length >= 3) {
                searches.value.shift();
            }
            searches.value.push(query);
        }

        localStorage.setItem("searches", JSON.stringify(searches.value));
    };

    return {
        searches,
        addSearch,
    };
});
