import { addDynamicIconSelectors } from '@iconify/tailwind';

/** @type {import('tailwindcss').Config} */
export default {
    // Biarkan content kosong, karena sudah di-handle oleh @source di app.css
    content: [], 
    theme: {
        extend: {},
    },
    plugins: [
        addDynamicIconSelectors({
            prefix: 'icon', 
        }),
    ],
};