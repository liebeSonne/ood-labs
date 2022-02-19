<?php

namespace App\Canvas;

use App\Style\RGBAColor;

class Canvas implements CanvasInterface
{
    private float $x = 0;
    private float $y = 0;
    private RGBAColor $lineColor;
    private RGBAColor $fillColor;
    private float $lineSize = 1;

    public function __construct()
    {
        $this->lineColor = new RGBAColor(0xFFFFFFFF);
        $this->fillColor = new RGBAColor(0xFFFFFFFF);
    }

    public function setLineColor(RGBAColor $color): void
    {
        $this->lineColor = $color;
    }

    public function beginFill(RGBAColor $color): void
    {
        $str = '<fill color="%s">' . "\n";
        $str = sprintf($str, $color->getHEX());
        echo $str;
    }

    public function endFill(): void
    {
        echo '</fill>' . "\n";
    }

    public function moveTo(float $x, float $y): void
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function lineTo(float $x, float $y): void
    {
        $str = '<line fromX="%.2f" fromY="%.2f" toX="%.2f" toY="%.2f" color="%s" size="%.2f"/>' . "\n";;
        $str = sprintf($str, $this->x, $this->y, $x, $y, $this->lineColor->getHEX(), $this->lineSize);
        echo $str;
        $this->moveTo($x, $y);
    }

    public function drawEllipse(float $left, float $top, float $width, float $height): void
    {
        $str = '<ellips fromX="%.2f" fromY="%.2f" toX="%.2f" toY="%.2f" color="%s" size="%.2f"/>)' . "\n";
        $str = sprintf($str, $left, $top, $width, $height, $this->lineColor->getHEX(), $this->lineSize);
        echo $str;
    }

    public function line(float $fromX, float $fromY, float $toX, float $toY): void
    {
        $this->moveTo($fromX, $fromY);
        $this->lineTo($toX, $toY);
    }

    public function fillEllipse(float $left, float $top, float $width, float $height): void
    {
        $this->beginFill($this->fillColor);
        $str = '<ellips fromX="%.2f" fromY="%.2f" toX="%.2f" toY="%.2f"/>)' . "\n";
        $str = sprintf($str, $left, $top, $width, $height);
        echo $str;
        $this->endFill();
    }

    public function fillRect(array $points): void
    {
        $this->beginFill($this->fillColor);

        $p0 = null;
        $cur = null;
        foreach ($points as $point) {
            if ($cur === null) {
                $cur = $point;
                $p0 = $point;
            } else {
                $this->line($cur->x, $cur->y, $point->x, $point->y);
                $cur = $point;
            }
        }
        if ($cur !== null && $p0 !== null) {
            $this->line($cur->x, $cur->y, $p0->x, $p0->y);
        }

        $this->endFill();
    }

    public function setFillColor(RGBAColor $color): void
    {
        $this->fillColor = $color;
    }

    public function setLineSize(float $size): void
    {
        $this->lineSize = $size;
    }
}