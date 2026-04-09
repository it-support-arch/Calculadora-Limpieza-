import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            // Asegúrate de que estos archivos existan en estas rutas
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        // --- REPARACIÓN PARA TÚNELES Y RED LOCAL ---
        host: '0.0.0.0', // Permite que Vite escuche en todas las interfaces de red
        port: 5173,      // Puerto por defecto de Vite
        strictPort: true,
        cors: true,       // Evita errores de "Cross-Origin" al cargar fuentes o scripts
        hmr: {
            // Si usas Ngrok, a veces es necesario poner aquí la URL del túnel
            // pero 'localhost' suele funcionar si el túnel está bien mapeado.
            host: 'localhost',
        },
        // ------------------------------------------
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
