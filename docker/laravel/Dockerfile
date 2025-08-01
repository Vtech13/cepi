FROM php:8.1-apache

# Installation des dépendances et extensions PHP
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip libpng-dev libonig-dev libxml2-dev openssl \
    && docker-php-ext-install pdo pdo_mysql zip

# Activation des modules Apache
RUN a2enmod rewrite ssl

# Génération des certificats SSL auto-signés
RUN openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
    -keyout /etc/ssl/private/laravel.key \
    -out /etc/ssl/certs/laravel.crt \
    -subj "/C=FR/ST=France/L=Paris/O=CliniqueCEPI/OU=IT/CN=localhost"

# Configuration des VirtualHosts
COPY vhost.conf /etc/apache2/sites-available/000-default.conf
COPY laravel-ssl.conf /etc/apache2/sites-available/default-ssl.conf
RUN a2ensite default-ssl

WORKDIR /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer