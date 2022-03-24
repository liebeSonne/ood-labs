<?php

namespace Tests\Unit\App;

use App\App\Adapter\CanvasModernAdapter;
use App\ModernGraphicsLib\ModernGraphicsRenderer;
use App\ModernGraphicsLib\Point;
use PHPUnit\Framework\TestCase;

class CanvasModernAdapterTest extends TestCase
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

        $adapter = new CanvasModernAdapter($renderer);

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
                    })
                ],
            );

        $adapter->moveTo($x1, $y1);
        $adapter->lineTo($x2, $y2);
        $adapter->lineTo($x3, $y3);
        $adapter->moveTo($x1, $y1);
        $adapter->lineTo($x3, $y3);
    }
}