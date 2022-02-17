<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\App\PaintPicture;
use App\App\PaintPicturePro;

$stream = STDIN;
$usePro = false;
$userInput = "";

echo "Should we use Pro version(y)?\n";
if (
    ($userInput = stream_get_line($stream, 65535, "\n"))
    && ($userInput == 'y' || $userInput == 'Y')
) {
    $usePro = true;
}

$userInput = "";
echo "Should we use new API (y)?\n";

if (
    ($userInput = stream_get_line($stream, 65535, "\n"))
    && ($userInput == 'y' || $userInput == 'Y')
) {
    if ($usePro) {
        PaintPicturePro::paintPictureOnModernGraphicsRenderer();
    } else {
        PaintPicture::paintPictureOnModernGraphicsRenderer();
    }
} else {
    if ($usePro) {
        PaintPicturePro::PaintPictureOnCanvas();
    } else {
        PaintPicture::PaintPictureOnCanvas();
    }
}
