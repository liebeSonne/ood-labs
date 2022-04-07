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
        $this->strokeStyleEnumerator = new StrokeStyleEnumerator($this);
        $this->fillStyleEnumerator = new FillStyleEnumerator($this);

        $this->outlineStyle = new CompoundStrokeStyle($this->strokeStyleEnumerator);
        $this->fillStyle = new CompoundFillStyle($this->fillStyleEnumerator);
    }

    //-- ShapeInterface:

    public function getFrame(): Rect
    {
        // фрейм расчитывается так, чтобы охватить фреймы всех входящих в группу элементов
        $groupFrame = new Rect(0,0,0,0);
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
            $groupFrame->left = $minX;
            $groupFrame->top = $minY;
            $groupFrame->width = $maxX - $minX;
            $groupFrame->height = $maxY - $minY;
        }

        return $groupFrame;
    }

    public function setFrame(Rect $frame): void
    {
        $groupFrame = $this->getFrame();
        $diffLeft = $frame->left - $groupFrame->left;
        $diffTop = $frame->top - $groupFrame->top;
        $scaleWidth = $groupFrame->width != 0 ? $frame->width / $groupFrame->width : 0;
        $scaleHeight = $groupFrame->height != 0 ? $frame->height / $groupFrame->height : 0;

        foreach ($this->shapes as $shape) {
            // пропорциональное изменение размера и положения всем элементам
            $shapeFrame = $shape->getFrame();
            $shapeFrame->left += $diffLeft;
            $shapeFrame->top += $diffTop;
            $shapeFrame->width *= $scaleWidth;
            $shapeFrame->height *= $scaleHeight;
            $shape->setFrame($shapeFrame);
        }
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