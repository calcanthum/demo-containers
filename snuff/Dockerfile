FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libonig-dev \
    libxml2-dev \
    git
    
RUN docker-php-ext-install mbstring pdo pdo_mysql mysqli

RUN a2enmod rewrite

RUN git clone https://github.com/jvoisin/snuffleupagus.git /usr/src/snuffleupagus \
    && cd /usr/src/snuffleupagus/src \
    && phpize \
    && ./configure \
    && make \
    && make install
    
RUN echo "extension=snuffleupagus.so" > /usr/local/etc/php/conf.d/20-snuffleupagus.ini \
    && echo "sp.configuration_file=/usr/local/etc/php/conf.d/snuffleupagus.rules" >> /usr/local/etc/php/conf.d/20-snuffleupagus.ini

COPY snuffleupagus.rules /usr/local/etc/php/conf.d/snuffleupagus.rules
