<?php

namespace Tests\Unit\Shape;

use App\Shape\Rect;
use App\Shape\Triangle;
use App\Style\RGBAColor;
use App\Style\StyleFill;
use App\Style\StyleStroke;
use PHPUnit\Framework\TestCase;

class ShapeTest extends TestCase
{
    public function testGetGroup(): void
    {
        $shape = new Triangle(
            new Rect(30,45,110,50),
            new StyleStroke(new RGBAColor(0x87240CCC), 1),
            new StyleFill(new RGBAColor(0x87240CFF))
        );

        $this->assertNull($shape->getGroup());
    }

    public function testFrame(): void
    {
        $shape = new Triangle(
            new Rect(30,45,110,50),
            new StyleStroke(new RGBAColor(0x87240CCC), 1),
            new StyleFill(new RGBAColor(0x87240CFF))
        );
        $frame = new Rect(15,23, 100, 300);

        $shape->setFrame($frame);

        $this->assertEquals($frame, $shape->getFrame());
    }

    public function testFillStyle(): void
    {
        $shape = new Triangle(
            new Rect(30,45,110,50),
            new StyleStroke(new RGBAColor(0x87240CCC), 1),
            new StyleFill(new RGBAColor(0x87240CFF))
        );
        $style = new StyleFill(new RGBAColor(0x66224411));

        $shape->getFillStyle()->setColor($style->getColor());

        $this->assertEquals($style->getColor()->getColor(), $shape->getFillStyle()->getColor()->getColor());
    }

    public function testOutlineStyle(): void
    {
        $shape = new Triangle(
            new Rect(30,45,110,50),
            new StyleStroke(new RGBAColor(0x87240CCC), 1),
            new StyleFill(new RGBAColor(0x87240CFF))
        );
        $style = new StyleStroke(new RGBAColor(0x66224411), 2);

        $shape->getOutlineStyle()->setColor($style->getColor());
        $shape->getOutlineStyle()->setSize($style->getSize());

        $this->assertEquals($style->getSize(), $shape->getOutlineStyle()->getSize());
        $this->assertEquals($style->getColor()->getColor(), $shape->getOutlineStyle()->getColor()->getColor());
    }

}
