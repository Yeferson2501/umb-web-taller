FROM php:8.2-apache

# Instala extensiones si son necesarias (por ejemplo mysqli o pdo_pgsql según tu BD)
RUN docker-php-ext-install mysqli

# Copiar todo el contenido de la carpeta api/ al directorio standard de Apache
COPY api/ /var/www/html/

# Establecer permisos adecuados
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Habilitar mod_rewrite si lo usas
RUN a2enmod rewrite

EXPOSE 80

