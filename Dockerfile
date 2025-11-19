# Usamos la imagen oficial de PHP con Apache
FROM php:8.2-apache

# 1. Instalar dependencias del sistema y librerías para PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    && docker-php-ext-install pdo pdo_pgsql

# 2. Configurar Apache para que la raíz sea la carpeta /public de Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# 3. Activar el módulo Rewrite de Apache (necesario para las rutas de Laravel)
RUN a2enmod rewrite

# AÑADE ESTA LÍNEA CRUCIAL PARA PERMITIR .htaccess EN EL SERVIDOR
RUN sed -i '/<Directory \/var\/www\/html>/a AllowOverride All' /etc/apache2/apache2.conf

# 4. Copiar todo tu código al contenedor
COPY . /var/www/html

# 5. Instalar Composer (el gestor de paquetes)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 6. Instalar las dependencias de tu proyecto
RUN composer install --no-dev --optimize-autoloader

# 7. Dar permisos a las carpetas de almacenamiento
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache


# 8. Ejecutar Migraciones y Arrancar Apache (Comando de Inicio del Contenedor)
CMD sh -c "php artisan route:clear && php artisan config:clear && php artisan migrate --force && apache2-foreground"