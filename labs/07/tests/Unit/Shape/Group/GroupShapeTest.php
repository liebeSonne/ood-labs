<?php

namespace Tests\Unit\Shape\Group;

use App\Shape\Group\GroupShape;
use App\Shape\Rect;
use App\Shape\Rectangle;
use App\Shape\Triangle;
use App\Style\RGBAColor;
use App\Style\StyleFill;
use App\Style\StyleStroke;
use PHPUnit\Framework\TestCase;

class GroupShapeTest extends TestCase
{
    public function testSetFrame(): void
    {
        $frame = new Rect(10, 20, 50, 100);

        $group = new GroupShape();
        $shape = new Rectangle(new Rect(15,16,20,20));
        $group->insertShape($shape, 0);
        $oldFrame = clone $shape->getFrame();

        $group->setFrame($frame);

        $newFrame = clone $group->getFrame();
        $this->assertEquals($frame->left, $newFrame->left);
        $this->assertEquals($frame->top, $newFrame->top);
        $this->assertEquals($frame->width, $newFrame->width);
        $this->assertEquals($frame->height, $newFrame->height);

        $newShapeFrame = clone $shape->getFrame();
        $this->assertNotEquals($oldFrame->left, $newShapeFrame->left);
        $this->assertNotEquals($oldFrame->top, $newShapeFrame->top);
        $this->assertNotEquals($oldFrame->width, $newShapeFrame->width);
        $this->assertNotEquals($oldFrame->height, $newShapeFrame->height);
    }

// для стратегии по умолчанию, возвращающей null
//    public function testGetFillStyleNull(): void
//    {
//        $group = $this->createGroup();
//
//        $style = $group->getFillStyle();
//
//        $this->assertNull($style);
//    }

    public function testGetFillStyleOneStyle(): void
    {
        $group = $this->createGroupOneStyle();

        $style = $group->getFillStyle();

        $this->assertNotNull($style);
        $this->assertEquals(0x87240CFF, $style->getColor()->getColor());
    }

// для стратегии по умолчанию, возвращающей null
//    public function testGetOutlineStyleNull(): void
//    {
//        $group = $this->createGroup();
//
//        $style = $group->getOutlineStyle();
//
//        $this->assertNull($style);
//    }

    public function testGetOutlineStyleOneStyle(): void
    {
        $group = $this->createGroupOneStyle();

        $style = $group->getOutlineStyle();

        $this->assertNotNull($style);
        $this->assertEquals(0x87240CCC, $style->getColor()->getColor());
        $this->assertEquals(1, $style->getSize());
        $this->assertEquals(true, $style->isEnabled());
    }

    private function createGroup() : GroupShape
    {
        $group = new GroupShape();

        $rectangle = new Rectangle(
            new Rect(15,16,20,20),
            new StyleStroke(new RGBAColor(0x87240CCC), 1),
            new StyleFill(new RGBAColor(0x87240CFF))
        );

        $triangle = new Triangle(
            new Rect(30,45,110,50),
            new StyleStroke(new RGBAColor(0x232323FF), 2),
            new StyleFill(new RGBAColor(0x888888FF))
        );

        $group->insertShape($rectangle, 0);
        $group->insertShape($triangle, 1);


        return $group;
    }

    private function createGroupOneStyle() : GroupShape
    {
        $group = new GroupShape();

        $rectangle = new Rectangle(
            new Rect(15,16,20,20),
            new StyleStroke(new RGBAColor(0x87240CCC), 1),
            new StyleFill(new RGBAColor(0x87240CFF))
        );

        $triangle = new Triangle(
            new Rect(30,45,110,50),
            new StyleStroke(new RGBAColor(0x87240CCC), 1),
            new StyleFill(new RGBAColor(0x87240CFF))
        );

        $group->insertShape($rectangle, 0);
        $group->insertShape($triangle, 1);


        return $group;
    }
}