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
    public function paintPicture(CanvasPainter $painter): void
    {
        $triangle = new Triangle(
            new Point(10, 15),
            new Point(100, 200),
            new Point(150, 250),
        );
        $rectangle = new Rectangle(
            new Point(30, 40),
            new Point(18, 24),
        );

        // TODO: нарисовать прямоугольник и треугольник при помощи painter
    }

    public static function paintPictureOnCanvas(): void
    {
        $simpleCanvas = new Canvas();
        $painter = new CanvasPainter($simpleCanvas);
        self::PaintPicture();
    }

    public static function paintPictureOnModernGraphicsRenderer(): void
    {
        $filename = 'php://stdout';
        $stream = new \SplFileObject($filename);
        $renderer = new ModernGraphicsRenderer($stream);

        // TODO: при помощи существующей функции PaintPicture() нарисовать
        // картину на renderer
        // Подсказка: используйте паттерн "Адаптер"
    }

}