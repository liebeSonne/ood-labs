<?php

namespace Tests\Unit\Shape\Group;

use App\Shape\Ellipse;
use App\Shape\Group\GroupShape;
use App\Shape\Rect;
use App\Shape\Rectangle;
use App\Shape\ShapeInterface;
use App\Shape\Triangle;
use App\Style\RGBAColor;
use App\Style\StyleFill;
use App\Style\StyleFillInterface;
use App\Style\StyleStroke;
use App\Style\StyleStrokeInterface;
use PHPUnit\Framework\TestCase;

class GroupShapeTest extends TestCase
{
    public function testGetShapeCount(): void
    {
        $group = new GroupShape();
        $group->insertShape($this->createMock(ShapeInterface::class), 0);
        $group->insertShape($this->createMock(ShapeInterface::class), 1);
        $group->insertShape($this->createMock(ShapeInterface::class), 3);

        $this->assertEquals(3, $group->getShapesCount());
    }

    public function testInsertGet(): void
    {
        $group = new GroupShape();
        $s1 = $this->createMock(ShapeInterface::class);
        $s2 = $this->createMock(ShapeInterface::class);
        $s3 = $this->createMock(ShapeInterface::class);
        $group->insertShape($s1, 0);
        $group->insertShape($s2, 1);
        $group->insertShape($s3, 2);

        $this->assertEquals($s1, $group->getShapeAtIndex(0));
        $this->assertEquals($s2, $group->getShapeAtIndex(1));
        $this->assertEquals($s3, $group->getShapeAtIndex(2));
    }

    public function testRemove(): void
    {
        $group = new GroupShape();

        $s1 = $this->createMock(ShapeInterface::class);
        $s2 = $this->createMock(ShapeInterface::class);
        $s3 = $this->createMock(ShapeInterface::class);

        $group->insertShape($s1, 0);
        $group->insertShape($s2, 1);
        $group->insertShape($s3, 2);

        $this->assertEquals(3, $group->getShapesCount());

        $group->removeShapeAtIndex(1);

        $this->assertEquals(2, $group->getShapesCount());
        $this->assertNull($group->getShapeAtIndex(1));
        $this->assertEquals($s1, $group->getShapeAtIndex(0));
        $this->assertEquals($s3, $group->getShapeAtIndex(2));
    }

    public function testOutlineStyleInstance(): void
    {
        $group = new GroupShape();

        $style = $group->getOutlineStyle();

        $this->assertInstanceOf(StyleStrokeInterface::class, $style);
    }

    public function testFillStyleInstance(): void
    {
        $group = new GroupShape();

        $style = $group->getFillStyle();

        $this->assertInstanceOf(StyleFillInterface::class, $style);
    }

    public function testGetGroup(): void
    {
        $group = new GroupShape();

        $this->assertEquals($group, $group->getGroup());
    }

    public function testSimpleSetGetFrame(): void
    {
        $frame = new Rect(10, 20, 50, 100);
        $group = new GroupShape();
        $shape = new Rectangle(new Rect(15,16,20,20),
            new StyleStroke(new RGBAColor(0), 0),
            new StyleFill(new RGBAColor(0))
        );
        $group->insertShape($shape, 0);
        $group->setFrame($frame);

        $groupFrame = $group->getFrame();

        $this->assertEquals($frame->height, $groupFrame->height);
        $this->assertEquals($frame->width, $groupFrame->width);
        $this->assertEquals($frame->top, $groupFrame->top);
        $this->assertEquals($frame->left, $groupFrame->left);
    }

    public function testSetFrameShapes(): void
    {
        $frame = new Rect(10, 20, 50, 100);

        $group = new GroupShape();
        $shape = new Rectangle(new Rect(15,16,20,20),
            new StyleStroke(new RGBAColor(0), 0),
            new StyleFill(new RGBAColor(0))
        );
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

    public function testSetFillStyle(): void
    {
        $group = new GroupShape();
        $triangle = new Triangle(
            new Rect(30,45,110,50),
            new StyleStroke(new RGBAColor(0x87240CCC), 1),
            new StyleFill(new RGBAColor(0x87240CFF))
        );

        $group->insertShape($triangle, 0);
        $color = new RGBAColor(0x00112233);

        $style = $group->getFillStyle();
        $style->setColor($color);

        $this->assertEquals($style->isEnabled(), $group->getFillStyle()->isEnabled());
        $this->assertEquals($style->getColor()->getColor(), $group->getFillStyle()->getColor()->getColor());
        $this->assertEquals($style->isEnabled(), $triangle->getFillStyle()->isEnabled());
        $this->assertEquals($style->getColor()->getColor(), $triangle->getFillStyle()->getColor()->getColor());
    }

    public function testSetStrokeStyle(): void
    {
        $group = new GroupShape();
        $triangle = new Triangle(
            new Rect(30,45,110,50),
            new StyleStroke(new RGBAColor(0x87240CCC), 1),
            new StyleFill(new RGBAColor(0x87240CFF))
        );

        $group->insertShape($triangle, 0);
        $color = new RGBAColor(0x00112233);

        $style = $group->getOutlineStyle();
        $style->setColor($color);
        $style->setSize(2);

        $this->assertEquals($style->isEnabled(), $group->getOutlineStyle()->isEnabled());
        $this->assertEquals($style->getColor()->getColor(), $group->getOutlineStyle()->getColor()->getColor());
        $this->assertEquals($style->getSize(), $group->getOutlineStyle()->getSize());
        $this->assertEquals($style->isEnabled(), $triangle->getOutlineStyle()->isEnabled());
        $this->assertEquals($style->getColor()->getColor(), $triangle->getOutlineStyle()->getColor()->getColor());
        $this->assertEquals($style->getSize(), $triangle->getOutlineStyle()->getSize());
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