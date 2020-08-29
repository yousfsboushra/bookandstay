FROM php:7.4-apache

COPY  ./src /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer
RUN composer install