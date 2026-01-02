FROM php:7.4-cli

# Установка необходимых расширений для Laravel + MySQL
RUN apt-get update && apt-get install -y \
        unzip \
        git \
        curl \
        libzip-dev \
        && docker-php-ext-install pdo pdo_mysql zip

# Установка Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www

COPY . .

RUN composer install --no-interaction --optimize-autoloader

EXPOSE 80

CMD php artisan serve --host=0.0.0.0 --port=80
