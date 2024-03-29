import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.scss',
                'resources/css/conversation.scss',
                'resources/css/form.scss',

                'resources/js/app.js',
                'resources/js/conversation.js',
                'resources/js/profile.js',
                'resources/js/map.js',
            ],
            refresh: true,
        }),
    ],
});
