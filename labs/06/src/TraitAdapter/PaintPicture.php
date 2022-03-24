<?php

namespace App\TraitAdapter;

use App\ShapeDrawingLib\CanvasPainter;
use App\ShapeDrawingLib\Point;
use App\ShapeDrawingLib\Rectangle;
use App\ShapeDrawingLib\Triangle;

class PaintPicture
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

    public static function paintPictureOnCanvas(): void
    {
        $simpleCanvas = new Canvas();
        $painter = new CanvasPainter($simpleCanvas);
        self::paintPicture($painter);
    }

    public static function paintPictureOnCanvasModernAdapter(): void
    {
        $filename = 'php://stdout';
        $stream = new \SplFileObject($filename);

        $canvas = new CanvasModernAdapter($stream);
        $painter = new CanvasPainter($canvas);

        $canvas->beginDraw();
        self::paintPicture($painter);
        $canvas->endDraw();
    }
}