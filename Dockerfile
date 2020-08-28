FROM php:7.4-apache
# For mbstring
RUN apt-get update && apt-get install libonig-dev
RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www
COPY  ./ /var/www

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer
RUN composer install

RUN chown -R www-data:www-data /var/www

COPY ./000-default.conf /etc/apache2/sites-available/000-default.conf
RUN echo "Listen 8080" >> /etc/apache2/ports.conf
RUN service apache2 restart

RUN a2enmod rewrite
EXPOSE 8080