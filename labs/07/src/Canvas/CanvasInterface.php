<?php

namespace App\Canvas;

use App\Style\RGBAColor;

interface CanvasInterface
{
    // Изменить цвет рисования линий
    public function setLineColor(RGBAColor $color): void;

    public function beginFill(RGBAColor $color): void;

    public function endFill(): void;

    public function moveTo(float $x, float $y): void;

    public function lineTo(float $x, float $y): void;

    // Нарисовать эллипс
    public function drawEllipse(float $left, float $top, float $width, float $height): void;


    // Нарисовать отрезок прямой линии
    public function line(float $fromX, float $fromY, float $toX, float $toY): void;

    // Заполнить эллипс
    public function fillEllipse(float $left, float $top, float $width, float $height): void;

    /**
     * Заполнить многоугольник, заданный массивом точек
     * @param Point[] $points
     * @return void
     */
    public function fillRect(array $points): void;

    //Изменить цвет заполнения внутренних областей фигур
    public function setFillColor(RGBAColor $color): void;

    // Изменить толщину рисования линий
    public function setLineSize(float $size): void;
}
