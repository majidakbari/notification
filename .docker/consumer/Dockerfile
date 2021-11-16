FROM php:8.0.12-cli

LABEL maintainer="Majid Akbari <majidakbariiii@gmail.com"

ARG WWW_DATA_USER_ID

# Install base packages
RUN apt-get update -y && \
    apt-get install -y \
        git \
        libzip-dev \
        zlib1g-dev \
        libssl-dev \
        libonig-dev \
        supervisor \
        sendmail \
        unzip && \
        docker-php-ext-install -j$(nproc) zip sockets \
        mbstring \
        pdo \
        pdo_mysql \
        zip

RUN docker-php-ext-configure bcmath --enable-bcmath && \
    docker-php-ext-install pcntl bcmath


RUN usermod -u ${WWW_DATA_USER_ID} www-data && \
    groupmod -g ${WWW_DATA_USER_ID} www-data


# Installing composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer

# Config apache and copy entrypoint
COPY ./config/* /etc/supervisor/conf.d/
COPY ./entrypoint.sh /
COPY ./../../consumer /var/www
RUN cd /var/www && composer install
RUN chmod +x /entrypoint.sh

# Override workdir to an existing directory
WORKDIR /var/www

ENTRYPOINT ["/entrypoint.sh"]