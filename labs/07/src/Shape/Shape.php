<?php

namespace App\Shape;

use App\Canvas\CanvasInterface;
use App\Shape\Group\GroupShapeInterface;
use App\Style\StyleInterface;

abstract class Shape implements ShapeInterface
{
    private Rect $frame;
    private StyleInterface $outlineStyle;
    private StyleInterface $fillStyle;
    private ?GroupShapeInterface $group;

    public function __construct(
        Rect $frame,
        StyleInterface $outlineStyle,
        StyleInterface $fillStyle,
        ?GroupShapeInterface $group = null
    ) {
        $this->setFrame($frame);
        $this->setOutlineStyle($outlineStyle);
        $this->setFillStyle($fillStyle);
        $this->group = $group;
    }

    public function getFrame(): Rect
    {
        return $this->frame;
    }

    public function setFrame(Rect $frame): void
    {
        $this->frame = $frame;
    }

    public function getOutlineStyle(): StyleInterface
    {
        return $this->outlineStyle;
    }

    public function setOutlineStyle(StyleInterface $style): void
    {
        $this->outlineStyle = $style;
    }

    public function getFillStyle(): StyleInterface
    {
        return $this->fillStyle;
    }

    public function setFillStyle(StyleInterface $style): void
    {
        $this->fillStyle = $style;
    }

    public function getGroup(): ?GroupShapeInterface
    {
        return $this->group;
    }

    abstract public function draw(CanvasInterface $canvas): void;
}
