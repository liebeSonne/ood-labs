<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\AppMenu;

$app = new AppMenu(STDIN);
$app->main();

