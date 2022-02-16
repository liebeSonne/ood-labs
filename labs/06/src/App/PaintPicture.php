<?php

namespace App\App;

use App\GraphicsLib\Canvas;
use App\ModernGraphicsLib\ModernGraphicsRenderer;
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

    public static function paintPictureOnModernGraphicsRenderer(): void
    {
        $filename = 'php://stdout';
        $stream = new \SplFileObject($filename);
        $renderer = new ModernGraphicsRenderer($stream);

        // при помощи существующей функции PaintPicture() нарисовать
        // картину на renderer
        // Подсказка: используйте паттерн "Адаптер"

        $canvas = new CanvasModernAdapter($renderer);
        $painter = new CanvasPainter($canvas);

        $renderer->beginDraw();
        self::paintPicture($painter);
        $renderer->endDraw();
    }

}