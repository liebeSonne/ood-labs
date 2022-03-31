## Паттерн "Адаптер"

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
composer run-script paint
composer run-script paint_trait
composer run-script paint_class_adapter
```

Run by php:
```bash
composer install
php ./public/index.php
php ./public/index_trait_adapter.php
php ./public/index_class_adapter.php
```