<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Client;
use App\Designer\Designer;
use App\Painter\Painter;
use App\Canvas\Canvas;
use App\Factory\ShapeFactory;

$shapeFactory = new ShapeFactory();
$designer = new Designer($shapeFactory);
$painter = new Painter();
$canvas = new Canvas();

$client = new Client($designer, $painter, $canvas);

$stream = null;

$file = $argv[1] ?? null;
if ($file !== null && file_exists($file) && is_readable($file)) {
    echo "\nFrom file (" . $file. "):\n";
    $stream = fopen($file, 'r');
} else {
    echo "\nInput shapes:\n";
    $stream = fopen("php://stdin","r");
}

$client->main($stream);
fclose($stream);
