<?php

namespace App\Shape;

use App\Canvas\CanvasInterface;
use App\Common\Color;
use App\Common\Point;

class Rectangle extends Shape
{
    private Point $leftTop;
    private Point $rightBottom;

    public function __construct(Point $leftTop, Point $rightBottom, string $color = Color::BLACK)
    {
        $this->leftTop = $leftTop;
        $this->rightBottom = $rightBottom;
        $this->setColor($color);
    }

    public function getLeftTop() : Point
    {
        return $this->leftTop;
    }

    public function getRightBottom() : Point
    {
        return $this->rightBottom;
    }

    public function draw(CanvasInterface $canvas): void
    {
        $lt = new Point($this->leftTop->getX(), $this->leftTop->getY());
        $rt = new Point($this->rightBottom->getX(), $this->leftTop->getY());
        $rb = new Point($this->rightBottom->getX(), $this->rightBottom->getY());
        $lb = new Point($this->leftTop->getX(), $this->rightBottom->getY());
        $color = $this->getColor();
        $canvas->setColor($color);
        $canvas->drawLine($lt, $rt);
        $canvas->drawLine($rt, $rb);
        $canvas->drawLine($rb, $lb);
        $canvas->drawLine($lb, $lt);
    }
}