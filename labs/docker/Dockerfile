FROM php:7.4-cli

RUN apt-get update
RUN apt-get install -y curl
RUN apt-get install -y zip unzip

RUN apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev

RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install -j$(nproc) gd

RUN pecl install -o ds && \
    echo "extension=ds.so" > /usr/local/etc/php/conf.d/ds.ini

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install
RUN composer dump-autoload

#CMD [ "php", "./public/index.php" ]


