import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    server:{
        hmr:{
            protocol:'ws',
            https:false,
            host:'192.168.56.56'
        },
        host: "192.168.56.56",
        https:false,
        watch:{
            usePolling:true
        }
    }
});
