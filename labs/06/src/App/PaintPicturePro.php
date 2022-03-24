<?php

namespace App\App;

use App\App\Adapter\CanvasModernAdapterPro;
use App\GraphicsLibPro\Canvas;
use App\ModernGraphicsLibPro\ModernGraphicsRenderer;
use App\ShapeDrawingLibPro\CanvasPainter;
use App\ShapeDrawingLibPro\Point;
use App\ShapeDrawingLibPro\Rectangle;
use App\ShapeDrawingLibPro\Triangle;

class PaintPicturePro
{
    public static function paintPicture(CanvasPainter $painter): void
    {
        $triangle = new Triangle(
            new Point(10, 15),
            new Point(100, 200),
            new Point(150, 250),
            0x33FF55
        );
        $rectangle = new Rectangle(new Point(30, 40),18, 24, 0x00FFFF);

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

        $canvas = new CanvasModernAdapterPro($renderer);
        $painter = new CanvasPainter($canvas);

        $renderer->beginDraw();
        self::paintPicture($painter);
        $renderer->endDraw();
    }

}