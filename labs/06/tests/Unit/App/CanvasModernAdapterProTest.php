<?php

namespace Tests\Unit\App;

use App\App\Adapter\CanvasModernAdapterPro;
use App\ModernGraphicsLibPro\ModernGraphicsRenderer;
use App\ModernGraphicsLibPro\Point;
use App\ModernGraphicsLibPro\RGBAColor;
use PHPUnit\Framework\TestCase;

class CanvasModernAdapterProTest extends TestCase
{
    public function testMoveToLineTo(): void
    {
        $renderer = $this->createMock(ModernGraphicsRenderer::class);

        $x1 = 10;
        $y1 = 20;
        $x2 = 50;
        $y2 = 70;
        $x3 = 100;
        $y3 = 120;
        $color = 0x5500FF;
        $r = ($color >> 16) & 0xFF;
        $g = ($color >> 8) & 0xFF;
        $b = $color & 0xFF;
        $a = 1;
        $rgba = new RGBAColor($r, $g, $b, $a);

        $adapter = new CanvasModernAdapterPro($renderer);

        $renderer->expects($this->exactly(3))->method('drawLine')
            ->withConsecutive(
                [
                    $this->callback(function($start) use ($x1, $y1) {
                    return ($start instanceof Point)
                        && $start->x === $x1
                        && $start->y === $y1;
                    }),
                    $this->callback(function($end) use ($x2, $y2) {
                    return ($end instanceof Point)
                        && $end->x === $x2
                        && $end->y === $y2;
                    }),
                    $this->callback(function($color) use ($rgba) {
                        return ($color instanceof RGBAColor)
                            && $color->r === $rgba->r
                            && $color->g === $rgba->g
                            && $color->b === $rgba->b
                            && $color->a === $rgba->a;
                    })
                ],
                [
                    $this->callback(function($start) use ($x2, $y2) {
                        return ($start instanceof Point)
                            && $start->x === $x2
                            && $start->y === $y2;
                    }),
                    $this->callback(function($end) use ($x3, $y3) {
                        return ($end instanceof Point)
                            && $end->x === $x3
                            && $end->y === $y3;
                    }),
                    $this->callback(function($color) use ($rgba) {
                        return ($color instanceof RGBAColor)
                            && $color->r === $rgba->r
                            && $color->g === $rgba->g
                            && $color->b === $rgba->b
                            && $color->a === $rgba->a;
                    })
                ],
                [
                    $this->callback(function($start) use ($x1, $y1) {
                        return ($start instanceof Point)
                            && $start->x === $x1
                            && $start->y === $y1;
                    }),
                    $this->callback(function($end) use ($x3, $y3) {
                        return ($end instanceof Point)
                            && $end->x === $x3
                            && $end->y === $y3;
                    }),
                    $this->callback(function($color) use ($rgba) {
                        return ($color instanceof RGBAColor)
                            && $color->r === $rgba->r
                            && $color->g === $rgba->g
                            && $color->b === $rgba->b
                            && $color->a === $rgba->a;
                    })
                ],
            );

        $adapter->setColor($color);
        $adapter->moveTo($x1, $y1);
        $adapter->lineTo($x2, $y2);
        $adapter->lineTo($x3, $y3);
        $adapter->moveTo($x1, $y1);
        $adapter->lineTo($x3, $y3);

    }
}