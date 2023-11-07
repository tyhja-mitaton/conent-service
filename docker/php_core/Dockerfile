FROM php:8.1-fpm

# Install system packages for PHP extensions recommended for Yii 2.0 Framework
RUN apt-get update && \
    apt-get install -y \
            curl \
            wget \
            unzip \
            zip \
            libmemcached-dev \
            git \
            bash-completion \
            curl \
            libfreetype6-dev \
            libcurl3-dev \
            libicu-dev \
            libmcrypt-dev \
            libfreetype6-dev \
            libjpeg-dev \
            libjpeg62-turbo-dev \
            libmagickwand-dev \
            libpq-dev \
            libpng-dev \
            libzip-dev \
            zlib1g-dev \
            mariadb-client \
            openssh-client \
            libxml2-dev \
            gettext \
            cron \
            supervisor \
            default-jre \
            procps && \
    docker-php-ext-configure gd && \
    docker-php-ext-configure bcmath && \
    docker-php-ext-install  soap \
                            zip \
                            curl \
                            bcmath \
                            exif \
                            gd \
                            iconv \
                            intl \
                            opcache \
                            pdo_mysql && \
    printf "\n" | pecl install \
        raphf \
        mcrypt \
        memcached \
        redis && \
    docker-php-ext-enable \
        raphf \
        memcached \
        redis

RUN apt-get update \
       && apt-get install -y libcurl4-openssl-dev libssl-dev \
       && pecl install pecl_http \
       && echo "extension=http.so" > /usr/local/etc/php/conf.d/docker-php-ext-http.ini

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- \
        --filename=composer.phar \
        --install-dir=/usr/local/bin

WORKDIR /home/www

# Add configuration files
COPY docker/php_core/image-files/ /

# Add GITHUB_API_TOKEN support for composer
RUN chmod 700 \
        /usr/local/bin/docker-entrypoint.sh \
        /usr/local/bin/docker-run.sh \
        /usr/local/bin/composer

# Startup script for FPM
ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
CMD ["docker-run.sh"]
