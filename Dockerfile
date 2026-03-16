FROM php:8.3-apache

# Habilitar mod_rewrite de Apache
RUN a2enmod rewrite

# Actualizar e instalar dependencias necesarias para PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install pdo pdo_pgsql pgsql
