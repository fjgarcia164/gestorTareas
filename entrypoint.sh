#!/bin/bash

# Detiene el script si algo falla (importante)
set -e

echo "Iniciando secuencia de arranque de Laravel..."

# 1. Limpiar Caché (Rutas y Configuración)
php artisan route:clear
php artisan config:clear

# 2. Inicializar Datos (Seeding y Migraciones)
php artisan db:seed
php artisan migrate --force

# 3. Dar permisos finales (necesario tras seeding)
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

echo "Inicialización de la BBDD terminada. Arrancando Apache."

# 4. Comando final: Iniciar el servidor Apache y mantenerlo en primer plano
exec apache2-foreground