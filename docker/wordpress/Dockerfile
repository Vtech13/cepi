FROM wordpress:php8.1-apache

# Installation des extensions PHP et des outils SSL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Activation du module SSL d'Apache
RUN a2enmod ssl

# Génération des certificats SSL auto-signés
RUN openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
    -keyout /etc/ssl/private/wordpress.key \
    -out /etc/ssl/certs/wordpress.crt \
    -subj "/C=FR/ST=France/L=Paris/O=CliniqueCEPI/OU=IT/CN=localhost"

# Configuration du VirtualHost SSL
COPY wordpress-ssl.conf /etc/apache2/sites-available/default-ssl.conf
RUN a2ensite default-ssl