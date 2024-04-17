# Utiliser l'image officielle PHP avec FPM
FROM php:7.4-fpm

# Installer les extensions PHP nécessaires
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copier l'application CodeIgniter dans le conteneur
COPY . /var/www/html

# Définir le répertoire de travail
WORKDIR /var/www/html