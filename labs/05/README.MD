## Паттерн "Команда"

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
composer run-script editor
composer run-script robot
```

Run by php:
```bash
composer install
php ./public/index.php
php ./public/robot.php
```