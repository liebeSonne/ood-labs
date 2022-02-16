<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\App\PaintPicture;

echo "Should we use new API (y)?\n";
$stream = STDIN;
$userInput = "";
if (
    ($userInput = stream_get_line($stream, 65535, "\n"))
    && ($userInput == 'y' || $userInput == 'Y')
) {
    PaintPicture::paintPictureOnModernGraphicsRenderer();
} else {
    PaintPicture::PaintPictureOnCanvas();
}
