FROM debian:latest

RUN apt-get update && apt-get install -y \
    apache2 \
    php8.2 \
    php8.2-cli \
    php8.2-mbstring \
    php8.2-mysql \
    php8.2-xml \
    libapache2-mod-php8.2 \
    git \
    php-dev \
    php-pear \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite headers

RUN git clone https://github.com/jvoisin/snuffleupagus.git /usr/src/snuffleupagus \
    && cd /usr/src/snuffleupagus/src \
    && phpize \
    && ./configure \
    && make \
    && make install

RUN echo "extension=snuffleupagus.so" > /etc/php/8.2/cli/conf.d/20-snuffleupagus.ini \
    && echo "extension=snuffleupagus.so" > /etc/php/8.2/apache2/conf.d/20-snuffleupagus.ini \
    && echo "sp.configuration_file=/etc/php/8.2/apache2/conf.d/snuffleupagus.rules" >> /etc/php/8.2/apache2/conf.d/20-snuffleupagus.ini

COPY snuffleupagus.rules /etc/php/8.2/apache2/conf.d/snuffleupagus.rules
COPY apache-security.conf /etc/apache2/conf-available/apache-security.conf
COPY custom-php.ini /etc/php/8.2/apache2/conf.d/

RUN a2enconf apache-security

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

CMD ["apache2ctl", "-D", "FOREGROUND"]
