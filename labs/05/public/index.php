<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Editor\Editor;

$DOCUMENT_PATH = realpath(__DIR__ . '/../data');
define('DOCUMENT_PATH', $DOCUMENT_PATH);
define('IMAGES_PATH', $DOCUMENT_PATH . '/images');

$editor = new Editor();
$editor->start();
