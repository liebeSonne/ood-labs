<?php

namespace App\Shape\Group;

use App\Canvas\CanvasInterface;
use App\Shape\Rect;
use App\Shape\ShapeInterface;
use App\Style\Compound\CompoundFillStyle;
use App\Style\Compound\CompoundStrokeStyle;
use App\Style\Enumerator\FillStyleEnumerator;
use App\Style\Enumerator\StrokeStyleEnumerator;
use App\Style\Enumerator\StyleEnumeratorInterface;
use App\Style\StyleFillInterface;
use App\Style\StyleStrokeInterface;

class GroupShapeNoStrategy implements GroupShapeInterface
{
    private Rect $frame;
    private ?StyleStrokeInterface $outlineStyle = null;
    private ?StyleFillInterface $fillStyle = null;

    /**
     * @var ShapeInterface[]
     */
    private array $shapes = [];

    private StyleEnumeratorInterface $strokeStyleEnumerator;
    private StyleEnumeratorInterface $fillStyleEnumerator;

    public function __construct()
    {
        $this->frame = new Rect(0,0,0,0);

        $this->strokeStyleEnumerator = new StrokeStyleEnumerator($this);
        $this->fillStyleEnumerator = new FillStyleEnumerator($this);

        $this->outlineStyle = new CompoundStrokeStyle($this->strokeStyleEnumerator);
        $this->fillStyle = new CompoundFillStyle($this->fillStyleEnumerator);
    }

    //-- ShapeInterface:

    public function getFrame(): Rect
    {
        // фрейм расчитывается так, чтобы охватить фреймы всех входящих в группу элементов
        $this->frame->left = 0;
        $this->frame->top = 0;
        $this->frame->width = 0;
        $this->frame->height = 0;
        $minX = null;
        $minY = null;
        $maxX = null;
        $maxY = null;
        foreach ($this->shapes as $shape) {
            $frame = $shape->getFrame();
            // не учитываем элементы с нулевыми размерами
            if ($frame->width == 0 || $frame->height == 0) {
                continue;
            }
            $x0 = $frame->left;
            $y0 = $frame->top;
            $xm = $frame->left + $frame->width;
            $ym = $frame->top + $frame->height;
            if ($minX === null || $minX > $x0) {
                $minX = $x0;
            }
            if ($minY === null || $minY > $y0) {
                $minY = $y0;
            }
            if ($maxX === null || $maxX < $xm) {
                $maxX = $xm;
            }
            if ($maxY === null || $maxY < $ym) {
                $maxY = $ym;
            }
            $this->frame->left = $minX;
            $this->frame->top = $minY;
            $this->frame->width = $maxX - $minX;
            $this->frame->height = $maxY - $minY;
        }

        return $this->frame;
    }

    public function setFrame(Rect $frame): void
    {
        $diffLeft = $frame->left - $this->frame->left;
        $diffTop = $frame->top - $this->frame->top;
        $scaleWidth = $this->frame->width != 0 ? $frame->width / $this->frame->width : 0;
        $scaleHeight = $this->frame->height != 0 ? $frame->height / $this->frame->height : 0;

        foreach ($this->shapes as $shape) {
            // пропорциональное изменение размера и положения всем элементам
            $shapeFrame = $shape->getFrame();
            $shapeFrame->left += $diffLeft;
            $shapeFrame->top += $diffTop;
            $shapeFrame->width *= $scaleWidth;
            $shapeFrame->height *= $scaleHeight;
            $shape->setFrame($shapeFrame);
        }

        $this->frame = $frame;
    }

    public function getOutlineStyle(): StyleStrokeInterface
    {
        return $this->outlineStyle;
    }

    public function getFillStyle(): StyleFillInterface
    {
        return $this->fillStyle;
    }

    public function getGroup(): ?GroupShapeInterface
    {
        return $this;
    }

    // -- ShapesInterface:

    public function getShapesCount(): int
    {
        return count($this->shapes);
    }
    public function insertShape(ShapeInterface $shape, int $position): void
    {
        $this->shapes[$position] = $shape;
    }
    public function getShapeAtIndex(int $index): ?ShapeInterface
    {
        return $this->shapes[$index] ?? null;
    }

    public function removeShapeAtIndex(int $index): void
    {
        unset($this->shapes[$index]);
    }

    public function draw(CanvasInterface $canvas): void
    {
        foreach ($this->shapes as $shape) {
            $shape->draw($canvas);
        }
    }
}