import './bootstrap';
import '../../css/frontend/app.css';
// import VueAxios from 'vue-axios';

// import 'tw-elements';

import { createApp, h } from 'vue';

import { InertiaProgress } from '@inertiajs/progress';
import { ZiggyVue } from '../../../vendor/tightenco/ziggy/dist/vue.m';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            // .use(VueAxios, axios)
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });