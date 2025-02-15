# Etapa de construcción
FROM composer:2 AS composer
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --ignore-platform-reqs --no-dev --optimize-autoloader

# Etapa final
FROM php:8.1-apache-bullseye

# Instalar dependencias del sistema
RUN apt-get update && \
    apt-get install -y --no-install-recommends \
    libssl-dev \
    zlib1g-dev \
    libxml2-dev \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libcurl4-openssl-dev \
    libjpeg-dev \
    libfreetype6-dev \
    locales \
    && rm -rf /var/lib/apt/lists/*

# Configurar locales
RUN sed -i -e '/en_US.UTF-8/s/^# //' -e '/es_ES.UTF-8/s/^# //' /etc/locale.gen && \
    locale-gen en_US.UTF-8 es_ES.UTF-8
ENV LANG en_US.UTF-8
ENV LANGUAGE en_US:en
ENV LC_ALL en_US.UTF-8

# Configurar e instalar extensiones de PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install \
    mysqli \
    zip \
    gd \
    intl \
    soap \
    opcache \
    exif \
    mbstring \
    curl

# Habilitar mod_rewrite de Apache
RUN a2enmod rewrite

# Copiar el código de Moodle y las dependencias de Composer
COPY . /var/www/html
COPY --from=composer /app/vendor /var/www/html/vendor

# Copiar la configuración personalizada de PHP
COPY php.ini /usr/local/etc/php/conf.d/moodle.ini

# Configurar permisos seguros
RUN mkdir -p /var/www/moodledata && \
    chown -R www-data:www-data /var/www/moodledata /var/www/html && \
    chmod -R 755 /var/www/html && \
    chmod -R 775 /var/www/moodledata

# Healthcheck para monitorear el estado de Apache
HEALTHCHECK --interval=30s --timeout=3s \
    CMD curl -f http://localhost/ || exit 1

# Comando por defecto
CMD ["apache2-foreground"]