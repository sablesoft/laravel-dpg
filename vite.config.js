import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import {viteStaticCopy} from 'vite-plugin-static-copy';
import path from 'path';

export default defineConfig({
    build: {
        minify: false,
    },
    plugins: [
        viteStaticCopy({
            targets: [
                {
                    src: path.join(__dirname, '/node_modules/questjs-core/assets/icons'),
                    dest: path.join(__dirname, '/public/build/assets')
                },
                {
                    src: path.join(__dirname, '/node_modules/codemirror/theme'),
                    dest: path.join(__dirname, '/public/build/assets')
                }
            ],
            silent: false
        }),
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
});
