FROM php:8.1-apache
RUN apt-get update && \
  apt-get install -y --no-install-recommends git libssl-dev zlib1g-dev libxml2-dev libzip-dev libpng-dev \ 
  libonig-dev libcurl4-openssl-dev libjpeg-dev libfreetype6-dev \
  && rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install mysqli zip gd intl soap opcache exif mbstring curl
RUN php -r "readfile('https://getcomposer.org/installer');" | php
RUN a2enmod rewrite
COPY ./ /var/www/html    
COPY php.ini /usr/local/etc/php/
RUN php composer.phar install --ignore-platform-reqs
RUN mkdir /var/www/moodledata && chown www-data /var/www/moodledata/
RUN chown www-data:www-data -R /var/www/html
RUN chmod -R 777 /var/www/html
CMD ["apache2-foreground"]
