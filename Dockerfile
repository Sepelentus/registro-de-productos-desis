FROM php:8.3-apache

# Habilitar mod_rewrite de Apache
RUN a2enmod rewrite

# Actualizar e instalar dependencias necesarias para PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# Configurar Apache para que la carpeta pública sea "app"
ENV APACHE_DOCUMENT_ROOT /var/www/html/app

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
