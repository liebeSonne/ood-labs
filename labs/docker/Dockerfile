FROM php:7.4-cli

RUN apt-get update
RUN apt-get install -y curl
RUN apt-get install -y zip unzip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install
RUN composer dump-autoload

#CMD [ "php", "./public/index.php" ]


