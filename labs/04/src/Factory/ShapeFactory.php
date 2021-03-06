<?php

namespace App\Factory;

use App\Common\Color;
use App\Command\Editor\EditorListCommand;
use App\Common\Point;
use App\Shape\Ellipse;
use App\Shape\Rectangle;
use App\Shape\RegularPolygon;
use App\Shape\Shape;
use App\Shape\Triangle;

class ShapeFactory implements ShapeFactoryInterface
{
    /**
     * @param string $description
     * @return Shape|null
     */
    public function createShape(string $description) : ?Shape
    {
        $count = sscanf($description, '%s', $name);
        if ($count < 1) return null;

        switch ($name) {
            case 'rectangle':
                return $this->createRectangle($description);
            case 'triangle':
                return $this->createTriangle($description);
            case 'ellipse':
                return $this->createEllipse($description);
            case 'polygon':
                return $this->createRegularPolygon($description);
            default:
                return null;
        }
    }

    private function createRectangle(string $description): ?Rectangle
    {
        $color = Color::BLACK;
        $count = sscanf($description,'%s%f%f%f%f%s', $name, $x1, $y1, $x2, $y2, $color);
        if ($count < 5) return null;
        $leftTop = new Point($x1, $y1);
        $rightBottom = new Point($x2, $y2);
        return new Rectangle($leftTop, $rightBottom, $color);
    }

    private function createTriangle(string $description): ?Triangle
    {
        $color = Color::BLACK;
        $count = sscanf($description,'%s%f%f%f%f%f%f%s', $name, $x1, $y1, $x2, $y2, $x3, $y3, $color);
        if ($count < 7) return null;
        $p1 = new Point($x1, $y1);
        $p2 = new Point($x2, $y2);
        $p3 = new Point($x3, $y3);
        return new Triangle($p1, $p2, $p3, $color);
    }

    private function createEllipse(string $description): ?Ellipse
    {
        $color = Color::BLACK;
        $count = sscanf($description,'%s%f%f%f%f%s', $name, $x1, $y1, $hr, $vr, $color);
        if ($count < 5) return null;
        $center = new Point($x1, $y1);
        $hRadius = $hr;
        $vRadius = $vr;
        return new Ellipse($center, $hRadius, $vRadius, $color);
    }

    private function createRegularPolygon(string $description): ?RegularPolygon
    {
        $color = Color::BLACK;
        $count = sscanf($description,'%s%f%f%f%d%s', $name, $x1, $y1, $r, $cv, $color);
        if ($count < 5) return null;
        $center = new Point($x1, $y1);
        $radius = $r;
        $countVertex = $cv;
        return new RegularPolygon($center, $radius, $countVertex, $color);
    }
}
