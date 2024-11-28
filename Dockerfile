FROM php:8.1-apache
RUN apt-get update && \
  apt-get install -y --no-install-recommends git libssl-dev zlib1g-dev libxml2-dev libzip-dev libpng-dev \ 
  libonig-dev libcurl4-openssl-dev libjpeg-dev libfreetype6-dev \ install -y nano \
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

# Instalar el paquete locales
RUN apt-get update && apt-get install -y locales

# Configurar locales para inglés y español
RUN apt-get update && apt-get install -y locales \
    && sed -i '/en_US.UTF-8/s/^# //g' /etc/locale.gen \
    && sed -i '/es_ES.UTF-8/s/^# //g' /etc/locale.gen \
    && locale-gen en_US.UTF-8 es_ES.UTF-8

# Configurar variables de entorno para el idioma principal (es_ES)
ENV LANG es_ES.UTF-8  
ENV LANGUAGE es_ES:es  
ENV LC_ALL es_ES.UTF-8
ENV LANG en_US.UTF-8
ENV LANGUAGE en_US:en
ENV LC_ALL en_US.UTF-8
