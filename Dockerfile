FROM php:8.2-fpm

# Installera systemberoenden och PHP-tillägg
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    # installera Node.js 18 LTS
    gnupg2 && \
    curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs && \
    docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Installera Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# (Valfritt) starta serve automatiskt
CMD ["php","artisan","serve","--host=0.0.0.0","--port=8000"]
