#!/bin/sh

# Démarrer PHP-FPM
php-fpm7 || echo "Failed to start PHP-FPM"

# Démarrer nginx en premier plan
nginx -g "daemon off;"
