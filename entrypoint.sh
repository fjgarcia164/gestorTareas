#!/bin/bash

# Este script ya no ejecuta la migración/seeding (Se hará a mano)
set -e

# 1. Limpia Caché (Esencial para evitar errores 404 de rutas)
php artisan route:clear
php artisan config:clear

# 2. Comando de arranque principal (entrega el control al contenedor)
exec "$@"