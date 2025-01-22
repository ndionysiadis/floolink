import '../css/app.css';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, DefineComponent, h } from 'vue';
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist";
import PhosphorIcons from "@phosphor-icons/vue";
import {MotionPlugin} from "@vueuse/motion";
import { createHead } from "@vueuse/head";


const appName = import.meta.env.VITE_APP_NAME || 'FlooLink';
const head = createHead();

createInertiaApp({
    title: (title) => `${appName} — ${title}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob<DefineComponent>('./Pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(PhosphorIcons)
            .use(MotionPlugin)
            .use(head)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
})
    .then(() => {
        console.log("FlooLink app initialized successfully.");
    })
    .catch((error) => {
        console.error("Failed to initialize FlooLink app:", error);
    });
