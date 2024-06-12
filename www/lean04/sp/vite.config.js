import react from '@vitejs/plugin-react';
import laravel from 'laravel-vite-plugin';
import { defineConfig, loadEnv } from 'vite';

export default function config({ mode }) {
    // Load app-level env vars to node-level env vars.
    process.env = { ...process.env, ...loadEnv(mode, process.cwd()) };
    return defineConfig({
        define: {
            'process.env': Object.fromEntries(
                Object.entries(process.env).map(([key, value]) =>
                    key.startsWith('VITE_') ? [key.slice(5), value] : [key, value]
                )
            ),
        },
        plugins: [
            laravel({
                input: 'resources/js/app.tsx',
                refresh: true,
            }),
            react(),
        ],
    });
}
