<?php

namespace App\Canvas;

use App\Style\RGBAColor;

class SVGCanvas implements CanvasInterface
{
    private float $x = 0;
    private float $y = 0;
    private RGBAColor $lineColor;
    private RGBAColor $fillColor;
    private RGBAColor $oldFillColor;
    private float $lineSize = 1;
    private bool $isFill = false;
    private bool $isStroke = true;

    private \SplFileObject $stream;

    public function __construct(\SplFileObject $stream, float $width, float $height)
    {
        $this->stream = $stream;

        $this->lineColor = new RGBAColor(0xFFFFFFFF);
        $this->fillColor = new RGBAColor(0xFFFFFFFF);
        $this->oldFillColor = new RGBAColor(0xFFFFFFFF);

        $str = '<svg width="%.2f" height="%.2f">';
        $str = sprintf($str, $width, $height);
        $this->write($str);
    }

    public function setLineColor(RGBAColor $color): void
    {
        $this->lineColor = $color;
    }

    public function beginFill(RGBAColor $color): void
    {
        $this->oldFillColor = $this->fillColor;
        $this->fillColor = $color;
        $this->isFill = true;
    }

    public function endFill(): void
    {
        $this->fillColor = $this->oldFillColor;
        $this->isFill = false;
    }

    public function moveTo(float $x, float $y): void
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function lineTo(float $x, float $y): void
    {
        $str = '';
        if ($this->isStroke) {
            $str = '<line x1="%.2f" y1="%.2f" x2="%.2f" y2="%.2f" style="stroke:%s;stroke-width:%.2f" />';
            $str = sprintf($str, $this->x, $this->y, $x, $y, $this->lineColor->getHEX(), $this->lineSize);
        }
        $this->write($str);
        $this->moveTo($x, $y);
    }

    public function drawEllipse(float $left, float $top, float $width, float $height): void
    {
        $cx = $left + $width / 2;
        $cy = $top + $height / 2;
        $rx = $width / 2;
        $ry = $height / 2;

        $str = '';
        if ($this->isFill && $this->isStroke) {
            $str = '<ellipse cx="%.2f" cy="%.2f" rx="%.2f" ry="%.2f" style="fill:%s;stroke:%s;stroke-width:%.2f" />';
            $str = sprintf($str, $cx, $cy, $rx, $ry, $this->fillColor->getHEX(), $this->lineColor->getHEX(), $this->lineSize);
        } elseif ($this->isFill) {
            $str = '<ellipse cx="%.2f" cy="%.2f" rx="%.2f" ry="%.2f" style="fill:%s;" />';
            $str = sprintf($str, $cx, $cy, $rx, $ry, $this->fillColor->getHEX());
        } elseif ($this->isStroke) {
            $str = '<ellipse cx="%.2f" cy="%.2f" rx="%.2f" ry="%.2f" style="fill:none;stroke:%s;stroke-width:%.2f" />';
            $str = sprintf($str, $cx, $cy, $rx, $ry, $this->lineColor->getHEX(), $this->lineSize);
        }

        $this->write($str);
    }

    public function line(float $fromX, float $fromY, float $toX, float $toY): void
    {
        $this->moveTo($fromX, $fromY);
        $this->lineTo($toX, $toY);
    }

    public function fillEllipse(float $left, float $top, float $width, float $height): void
    {
        $this->isStroke = false;
        $this->beginFill($this->fillColor);
        $this->drawEllipse($left, $top, $width, $height);
        $this->endFill();
        $this->isStroke = true;
    }

    public function fillRect(array $points): void
    {
        $this->isStroke = false;
        $this->beginFill($this->fillColor);
        $this->drawRect($points);
        $this->endFill();
        $this->isStroke = true;
    }

    public function setFillColor(RGBAColor $color): void
    {
        $this->fillColor = $color;
    }

    public function setLineSize(float $size): void
    {
        $this->lineSize = $size;
    }

    public function drawRect(array $points): void
    {
        $arrPoints = array_map(function (Point $p): string {
            return sprintf('%.2f,%.2f', $p->x, $p->y);
        }, $points);
        $strPoints = implode(' ', $arrPoints);

        $str = '';
        if ($this->isFill && $this->isStroke) {
            $str = '<polygon points="%s" style="fill:%s;stroke:%s;stroke-width:%.2f" />';
            $str = sprintf($str, $strPoints, $this->fillColor->getHEX(), $this->lineColor->getHEX(), $this->lineSize);
        } elseif ($this->isFill) {
            $str = '<polygon points="%s" style="fill:%s;" />';
            $str = sprintf($str, $strPoints, $this->fillColor->getHEX());
        } elseif ($this->isStroke) {
            $str = '<polygon points="%s" style="fill:none;stroke:%s;stroke-width:%.2f" />';
            $str = sprintf($str, $strPoints, $this->lineColor->getHEX(), $this->lineSize);
        }

        $this->write($str);
    }

    private function write(string $str): void
    {
        $this->stream->fwrite($str . "\n");
    }

    public function __destruct()
    {
        $this->write("</svg>");
    }
}
