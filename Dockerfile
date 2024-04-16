# Utiliser l'image de base Nginx Alpine
FROM nginx:alpine

# Installer PHP et les extensions nécessaires
RUN apk update && apk add --no-cache \
    php-fpm \
    php-mysqli \
    php-json \
    php-openssl \
    php-curl \
    php-zlib \
    php-xml \
    php-phar \
    php-intl \
    php-dom \
    php-xmlreader \
    php-session \
    php-mbstring \
    php-gd \
    && ln -s /usr/sbin/php-fpm7 /usr/sbin/php-fpm 

# Copier la configuration de Nginx pour supporter PHP
COPY nginx.conf /etc/nginx/nginx.conf

# Copier le script de démarrage
COPY start.sh /start.sh
RUN chmod +x /start.sh

# Définir le répertoire de travail
WORKDIR /var/www/html

# Exposer le port 80
EXPOSE 80

# Commande de démarrage
CMD ["/start.sh"]
