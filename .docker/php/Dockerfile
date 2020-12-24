FROM php:7.2-buster

RUN apt-get update && apt-get install \
libxml2-dev \
libcurl4-gnutls-dev \
zlib1g-dev \
git \
zip \
-y 
# Extensions
RUN docker-php-ext-install \
mbstring \
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




