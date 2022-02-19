<?php

namespace App\Shape;

use App\Canvas\CanvasInterface;
use App\Shape\Group\GroupShapeInterface;
use App\Style\StyleFillInterface;
use App\Style\StyleStrokeInterface;

abstract class Shape implements ShapeInterface
{
    private Rect $frame;
    private ?StyleStrokeInterface $outlineStyle;
    private ?StyleFillInterface $fillStyle;

    public function __construct(
        Rect $frame,
        ?StyleStrokeInterface $outlineStyle = null,
        ?StyleFillInterface $fillStyle = null
    ) {
        $this->setFrame($frame);
        $this->setOutlineStyle($outlineStyle);
        $this->setFillStyle($fillStyle);
    }

    public function getFrame(): Rect
    {
        return $this->frame;
    }

    public function setFrame(Rect $frame): void
    {
        $this->frame = $frame;
    }

    public function getOutlineStyle(): ?StyleStrokeInterface
    {
        return $this->outlineStyle;
    }

    public function setOutlineStyle(?StyleStrokeInterface $style): void
    {
        $this->outlineStyle = $style;
    }

    public function getFillStyle(): ?StyleFillInterface
    {
        return $this->fillStyle;
    }

    public function setFillStyle(?StyleFillInterface $style): void
    {
        $this->fillStyle = $style;
    }

    public function getGroup(): ?GroupShapeInterface
    {
        return null;
    }

    abstract public function draw(CanvasInterface $canvas): void;
}
