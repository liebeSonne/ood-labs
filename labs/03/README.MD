## Паттерн "Декоратор"

Run by docker:
```bash
docker-compose up
```

Run by php composer:
```bash
composer install
composer run-script app
```

Run by php:
```bash
composer install
php ./public/index.php
php ./public/index_stream.php --encrypt 3 --encrypt 100500 --compress input.dat output.dat
php ./public/index_stream.php --decompress --decrypt 100500 --decrypt 3 output.dat input.dat.restored
```