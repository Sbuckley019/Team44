import "./bootstrap";
import "../css/app.css";
import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";
import { numericOnlyDirective } from "./directive";
import { createPinia } from "pinia";

const appName = import.meta.env.VITE_APP_NAME || "Gains";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });
        const pinia = createPinia();

        app.use(pinia);
        app.directive("numeric-only", numericOnlyDirective);
        app.use(plugin);
        app.use(ZiggyVue);
        app.mount(el);

        return app;
    },
    progress: false,
});
