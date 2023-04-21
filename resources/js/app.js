import './bootstrap';
import '../theme/css/bootstrap.css'
import '../theme/css/style.css'

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import AppLayout from "@/Layouts/AppLayout.vue";
import VueGtag from "vue-gtag";
import GuestLayout from "@/Layouts/GuestLayout.vue";

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: async(name) => {
        const pages = import.meta.glob('./Pages/**/*.vue');
        const imported = pages[`./Pages/${name}.vue`];
        const page = (await (typeof imported === "function" ? imported() : imported)).default;


        if(name.match(/Auth/)) {
            page.layout ??= GuestLayout;
        }
        else {
            page.layout ??= AppLayout;
        }


        return page;
    },
    // resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(VueGtag, {
                config: { id: import.meta.env.VITE_GA_TAG }
            })
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
