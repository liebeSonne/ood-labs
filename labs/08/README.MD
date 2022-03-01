## Паттерн "Состояние"

Run by docker:
```bash
docker-compose up
```

Run by php composer:
```bash
composer install
composer run-script app
# or
composer run-script tests
composer run-script machines-test
composer run-script multi-machines-test
composer run-script menu
```

Run by php:
```bash
composer install
php ./public/index.php
php ./public/index_multi.php
php ./public/index_menu.php
```