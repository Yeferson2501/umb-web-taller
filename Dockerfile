FROM php:8.2-apache

# Instalar extensiones necesarias
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# Copiar proyecto
COPY api/ /var/www/html/

# Habilitar mod_rewrite
RUN a2enmod rewrite
