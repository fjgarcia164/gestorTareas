#!/bin/bash

set -e

php artisan route:clear
php artisan config:clear

exec "$@"