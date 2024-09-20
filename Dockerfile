FROM php:8.1-apache
RUN apt-get update && \
  apt-get install -y --no-install-recommends git libssl-dev zlib1g-dev libxml2-dev libzip-dev libpng-dev \
  && rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-install mysqli zip gd intl soap opcache exif && docker-php-ext-enable mysqli
RUN php -r "readfile('https://getcomposer.org/installer');" | php
#Parte del composer
RUN a2enmod rewrite
COPY ./ /var/www/html
COPY php.ini /usr/local/etc/php/
RUN php composer.phar install --ignore-platform-reqs
RUN mkdir /var/www/moodledata && chown www-data /var/www/moodledata/
RUN chown www-data:www-data -R /var/www/html
CMD ["apache2-foreground"]
