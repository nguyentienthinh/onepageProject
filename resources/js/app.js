require('./bootstrap');

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

const appName = 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        var vue = createApp({ render: () => h(app, props) })
            .use(plugin)
            .mixin({ methods: { route } });

        return vue.mount(el);;
    },
});

InertiaProgress.init({ color: '#4B5563' });