/* eslint-disable comma-dangle */
import './bootstrap';

import { createRoot } from 'react-dom/client';
import { ChakraProvider } from '@chakra-ui/react';
import { createInertiaApp } from '@inertiajs/react';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

import '../css/app.css';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

const queryClient = new QueryClient();

void createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: async (name) => resolvePageComponent(`./Pages/${name}.tsx`, import.meta.glob('./Pages/**/*.tsx')),
    setup({ el, App, props }) {
        const root = createRoot(el);

        root.render(
            <ChakraProvider>
                <QueryClientProvider client={queryClient}>
                    <App {...props} />
                </QueryClientProvider>
            </ChakraProvider>
        );
    },
    progress: {
        color: '#4B5563',
    },
});
