<?php

namespace App\App;

use App\App\Adapter\CanvasModernClassAdapter;
use App\ShapeDrawingLib\CanvasPainter;
use App\ShapeDrawingLib\Point;
use App\ShapeDrawingLib\Rectangle;
use App\ShapeDrawingLib\Triangle;

class PaintPictureClassAdapter
{
    public static function paintPicture(CanvasPainter $painter): void
    {
        $triangle = new Triangle(
            new Point(10, 15),
            new Point(100, 200),
            new Point(150, 250),
        );
        $rectangle = new Rectangle(new Point(30, 40),18, 24);

        $painter->draw($triangle);
        $painter->draw($rectangle);
    }

    public static function paintPictureOnClassAdapter(): void
    {
        $filename = 'php://stdout';
        $stream = new \SplFileObject($filename);
        $canvas = new CanvasModernClassAdapter($stream);

        $painter = new CanvasPainter($canvas);

        $canvas->beginDraw();
        self::paintPicture($painter);
        $canvas->endDraw();
    }

}