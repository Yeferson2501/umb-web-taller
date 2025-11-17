FROM php:8.2-apache

# Instalar PDO Postgres
RUN docker-php-ext-install pdo pdo_pgsql

COPY api/ /var/www/html/

RUN a2enmod rewrite
