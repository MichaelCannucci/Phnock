FROM php:8.0-buster

RUN apt-get update && apt-get install \
libxml2-dev \
libcurl4-gnutls-dev \
zlib1g-dev \
libzip-dev \
git \
zip \
-y 
# Extensions
RUN docker-php-ext-install \
soap \
curl \
zip 
# Xdebug
RUN pecl install xdebug \
&& \
docker-php-ext-enable xdebug 
# Composer
RUN curl https://getcomposer.org/composer-stable.phar --output ./composer && \
mv composer /usr/local/bin/ && \
chmod 0777 /usr/local/bin/composer