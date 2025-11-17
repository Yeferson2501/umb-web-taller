FROM php:8.2-apache

# Instalar pgsql y dependencias para PostgreSQL
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pgsql

# Habilitar mod_rewrite (opcional pero recomendado)
RUN a2enmod rewrite

# Copiar toda la carpeta api/ al DocumentRoot
COPY api/ /var/www/html/

# Permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE 80
