FROM php:8.1-fpm

# arguments for user/group (optional)
ARG USER=www-data
ARG UID=1000
ARG GID=1000

# install system dependencies and supervisor
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libwebp-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    libicu-dev \
    libpng-dev \
    supervisor \
    && rm -rf /var/lib/apt/lists/*

# install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip intl

# install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# create working dir
WORKDIR /var/www/html

# copy composer files first for caching
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader || true

# copy app
COPY . .

# copy supervisord config (ensure docker/supervisord.conf exists in repo)
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# set permissions
RUN chown -R ${USER}:${USER} /var/www/html \
    && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache || true

# expose php-fpm port (if needed)
EXPOSE 9000

# default command: run supervisord which will manage php-fpm, queue worker, websockets (as configured)
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
