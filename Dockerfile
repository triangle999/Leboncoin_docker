FROM php:8.2-apache

# Activer mod_rewrite et définir le DocumentRoot sur /var/www/public
RUN a2enmod rewrite \
 && sed -ri -e 's!/var/www/html!/var/www/public!g' /etc/apache2/sites-available/000-default.conf \
 && sed -ri -e 's!<Directory /var/www/>!<Directory /var/www/public/>!g' /etc/apache2/apache2.conf \
 && sed -ri -e 's!DocumentRoot /var/www/html!DocumentRoot /var/www/public!g' /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www

# Installation des dépendances nécessaires à certaines extensions PHP
RUN apt-get update && apt-get install -y \
    libicu-dev \
    unzip \
    git \
    zip \
    && docker-php-ext-install \
    pdo \
    pdo_mysql \
    intl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Désactivation éventuelle d'un Xdebug déjà activé par défaut
RUN rm -f /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini || true

# Installation conditionnelle de Xdebug uniquement s'il n'est pas déjà installé
RUN if ! php -m | grep -i xdebug; then \
      pecl install xdebug && docker-php-ext-enable xdebug; \
    else \
      echo "Xdebug déjà installé, on passe."; \
    fi

# Fichier php.ini personnalisé (à créer dans ./php/conf/php.ini)
COPY ./php/conf/php.ini /usr/local/etc/php/php.ini

# Configuration de Xdebug (copie du fichier une seule fois)
COPY ./php/conf/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini