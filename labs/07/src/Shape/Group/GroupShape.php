<?php

namespace App\Shape\Group;

use App\Canvas\CanvasInterface;
use App\Shape\Rect;
use App\Shape\ShapeInterface;
use App\Style\CompoundStyle;
use App\Style\FillStyleEnumerator;
use App\Style\StyleFillInterface;
use App\Style\StyleStrokeInterface;

class GroupShape implements GroupShapeInterface
{
    private Rect $frame;
    private ?StyleStrokeInterface $outlineStyle = null;
    private ?StyleFillInterface $fillStyle = null;

    /**
     * @var ShapeInterface[]
     */
    private array $shapes = [];

    public function __construct()
    {
        $this->frame = new Rect(0,0,0,0);
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
        // пропорциональное изменение размера и положения всем элементам
        $diffLeft = $frame->left - $this->frame->left;
        $diffTop = $frame->top - $this->frame->top;
        $scaleWidth = $this->frame->width != 0 ? $frame->width / $this->frame->width : 0;
        $scaleHeight = $this->frame->height != 0 ? $frame->height / $this->frame->height : 0;

        foreach ($this->shapes as $shape) {
            $shapeFrame = $shape->getFrame();
            $shapeFrame->left += $diffLeft;
            $shapeFrame->top += $diffTop;
            $shapeFrame->width *= $scaleWidth;
            $shapeFrame->height *= $scaleHeight;
            $shape->setFrame($shapeFrame);
        }

        $this->frame = $frame;
    }

    public function getOutlineStyle(): ?StyleStrokeInterface
    {
        // возвращает null или стиль, если он одинаковый у всех элементов группы
        $curStyle = null;
        $isFirst = true;
        foreach ($this->shapes as $shape) {
            $style = $shape->getOutlineStyle();
            // если есть хотябы один null, то результат null
            if ($style === null) {
                $curStyle = null;
                break;
            }
            // если первый - берём его значение
            if ($isFirst) {
                $curStyle = clone $style;
                $isFirst = false;
                continue;
            }
            if ($style->getSize() != $curStyle->getSize()
                || $style->getColor()->getColor() !== $curStyle->getColor()->getColor()
                || $style->isEnabled() !== $curStyle->isEnabled()
            ) {
                $curStyle = null;
                break;
            }
        }

        $this->outlineStyle = $curStyle;

        return $this->outlineStyle;
    }

    public function setOutlineStyle(?StyleStrokeInterface $style): void
    {
        // распространение стмлей на все элементы
        foreach ($this->shapes as $shape) {
            $shape->setOutlineStyle($style);
        }
        $this->outlineStyle = $style;
    }

    public function getFillStyle(): ?StyleFillInterface
    {
        // возвращает null или стиль, если он одинаковый у всех элементов группы
        $curStyle = null;
        $isFirst = true;
        foreach ($this->shapes as $shape) {
            $style = $shape->getFillStyle();
            // если есть хотябы один null, то результат null
            if ($style === null) {
                $curStyle = null;
                break;
            }
            // если первый - берём его значение
            if ($isFirst) {
                $curStyle = clone $style;
                $isFirst = false;
                continue;
            }
            if ($style->getColor()->getColor() !== $curStyle->getColor()->getColor()
                || $style->isEnabled() !== $curStyle->isEnabled()
            ) {
                $curStyle = null;
                break;
            }
        }

        $this->fillStyle = $curStyle;

        return $this->fillStyle;
    }

    public function setFillStyle(?StyleFillInterface $style): void
    {
        // распространение стмлей на все элементы
        foreach ($this->shapes as $shape) {
            $shape->setFillStyle($style);
        }
        $this->fillStyle = $style;
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