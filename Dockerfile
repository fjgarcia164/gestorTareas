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

# 3. Activar el módulo Rewrite y AllowOverride (FIX 404)
RUN a2enmod rewrite
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# 4. Copiar todo tu código al contenedor
COPY . /var/www/html

# 5. Instalar Composer y dependencias
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# 6. Permisos y Script de Inicialización
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# 7. Comando de Inicio FINAL
# Le decimos a Docker que ejecute el script, que a su vez se encarga de iniciar Apache
CMD ["/usr/local/bin/entrypoint.sh"]