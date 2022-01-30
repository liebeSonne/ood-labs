<?php

namespace Tests\Unit\Draft;

use App\Draft\PictureDraft;
use App\Shape\Shape;
use PHPUnit\Framework\TestCase;

class PictureDraftTest extends TestCase
{
    public function testGetters(): void
    {
        $pd = new PictureDraft();

        $this->assertEquals(0, $pd->getShapeCount());
        $this->assertNull($pd->getShape($index = 10));
    }

    public function testAdd(): void
    {
        $pd = new PictureDraft();

        $shape = $this->createMock(Shape::class);

        $this->assertEquals(0, $pd->getShapeCount());

        $count = 3;
        for ($i = 0; $i < $count; $i++)
        {
            $pd->add($shape);
        }

        $this->assertEquals($count, $pd->getShapeCount());
        $this->assertEquals($shape, $pd->getShape(1));
    }
}