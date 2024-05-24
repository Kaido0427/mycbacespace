# Utiliser une image PHP avec PHP-FPM
FROM php:8.1-fpm

# Installer les dépendances nécessaires
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    curl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copier les fichiers du projet
COPY . /var/www

# Définir le répertoire de travail
WORKDIR /var/www

# Exposer le port 9000 pour PHP-FPM
EXPOSE 9000

# Exécuter PHP-FPM
CMD ["php-fpm"]