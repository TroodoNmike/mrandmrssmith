FROM php:8.0-fpm

RUN apt-get update && apt-get install -y git libzip-dev zip unzip wget
RUN docker-php-ext-install zip

# for debugging
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN wget https://getcomposer.org/download/latest-stable/composer.phar \
    && mv composer.phar /usr/local/bin/composer && chmod +x /usr/local/bin/composer

RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony

