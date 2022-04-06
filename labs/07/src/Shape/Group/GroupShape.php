<?php

namespace App\Shape\Group;

use App\Canvas\CanvasInterface;
use App\Shape\Enumerator\ShapesEnumerator;
use App\Shape\Group\Strategy\GroupGetFillStyleCompoundStrategy;
use App\Shape\Group\Strategy\GroupGetFillStyleStrategy;
use App\Shape\Group\Strategy\GroupGetFillStyleStrategyInterface;
use App\Shape\Group\Strategy\GroupGetFrameStrategyInterface;
use App\Shape\Group\Strategy\GroupGetOutlineStyleCompoundStrategy;
use App\Shape\Group\Strategy\GroupGetOutlineStyleStrategy;
use App\Shape\Group\Strategy\GroupGetOutlineStyleStrategyInterface;
use App\Shape\Group\Strategy\GroupSetFillStyleCompoundStrategy;
use App\Shape\Group\Strategy\GroupSetFillStyleStrategy;
use App\Shape\Group\Strategy\GroupSetFillStyleStrategyInterface;
use App\Shape\Group\Strategy\GroupSetFrameStrategy;
use App\Shape\Group\Strategy\GroupSetFrameStrategyInterface;
use App\Shape\Group\Strategy\GroupSetOutlineStyleCompoundStrategy;
use App\Shape\Group\Strategy\GroupSetOutlineStyleStrategy;
use App\Shape\Group\Strategy\GroupSetOutlineStyleStrategyInterface;
use App\Shape\Rect;
use App\Shape\ShapeInterface;
use App\Shape\Group\Strategy\GroupGetFrameStrategy;
use App\Style\Compound\CompoundFillStyle;
use App\Style\Compound\CompoundStrokeStyle;
use App\Style\Enumerator\FillStyleEnumerator;
use App\Style\Enumerator\StrokeStyleEnumerator;
use App\Style\Enumerator\StyleEnumeratorInterface;
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

    private ShapesEnumerator $shapesEnumerator;
    private GroupGetFrameStrategyInterface $strategyGetFrame;
    private GroupSetFrameStrategyInterface $strategySetFrame;

    private StyleEnumeratorInterface $strokeStyleEnumerator;
//    private GroupGetOutlineStyleStrategyInterface $strategyGetOutlineStyle;
//    private GroupSetOutlineStyleStrategyInterface $strategySetOutlineStyle;
//
    private StyleEnumeratorInterface $fillStyleEnumerator;
//    private GroupGetFillStyleStrategyInterface $strategyGetFillStyle;
//    private GroupSetFillStyleStrategyInterface $strategySetFillStyle;

    public function __construct()
    {
        $this->frame = new Rect(0,0,0,0);

        // варианты с вынесением алгоритмов в стратегии и перебором через энумератор элементов
        $this->shapesEnumerator = new ShapesEnumerator($this);
        $this->strategyGetFrame = new GroupGetFrameStrategy($this->frame, $this->shapesEnumerator);
        $this->strategySetFrame = new GroupSetFrameStrategy($this->frame, $this->shapesEnumerator);

        // стратегии обработки стилей через энумератор элементов
//        $this->strategyGetOutlineStyle = new GroupGetOutlineStyleStrategy($this->shapesEnumerator);
//        $this->strategySetOutlineStyle = new GroupSetOutlineStyleStrategy($this->outlineStyle, $this->shapesEnumerator);
//        $this->strategyGetFillStyle = new GroupGetFillStyleStrategy($this->fillStyle, $this->shapesEnumerator);
//        $this->strategySetFillStyle = new GroupSetFillStyleStrategy($this->fillStyle, $this->shapesEnumerator);

        // стратегии обработки стилей через энумератор стилей
        $this->strokeStyleEnumerator = new StrokeStyleEnumerator($this);
//        $this->strategyGetOutlineStyle = new GroupGetOutlineStyleCompoundStrategy($this->outlineStyle, $this->strokeStyleEnumerator);
//        $this->strategySetOutlineStyle = new GroupSetOutlineStyleCompoundStrategy($this->outlineStyle, $this->strokeStyleEnumerator);
//
        $this->fillStyleEnumerator = new FillStyleEnumerator($this);
//        $this->strategyGetFillStyle = new GroupGetFillStyleCompoundStrategy($this->fillStyle, $this->fillStyleEnumerator);
//        $this->strategySetFillStyle = new GroupSetFillStyleCompoundStrategy($this->fillStyle, $this->fillStyleEnumerator);

        $this->outlineStyle = new CompoundStrokeStyle($this->strokeStyleEnumerator);
        $this->fillStyle = new CompoundFillStyle($this->fillStyleEnumerator);
    }

    //-- ShapeInterface:

    public function getFrame(): Rect
    {
        return $this->strategyGetFrame->getFrame();
    }

    public function setFrame(Rect $frame): void
    {
        $this->strategySetFrame->setFrame($frame);
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