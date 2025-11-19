#!/bin/bash

# 1. Detiene el script si una migración o seeder falla
set -e
# entrypoint.sh (Añadir debajo de set -e)

# Esperar 30 segundos para que la BBDD termine de arrancar y esté accesible
sleep 120
echo "Iniciando secuencia de inicialización..."

# 2. Comandos de Mantenimiento y Seeding
php artisan route:clear      # Limpia rutas
php artisan config:clear     # Limpia configuración
php artisan db:seed          # Crea el Usuario Dummy (Fix 23503)
php artisan migrate --force  # Asegura la existencia de tablas

# 3. Dar permisos finales
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

echo "Inicialización terminada. Arrancando servidor Apache..."

# 4. Comando de arranque principal (entrega el control al contenedor)
# entrypoint.sh - ÚLTIMA LÍNEA
exec "$@"