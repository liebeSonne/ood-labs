<?php

namespace App\ModernGraphicsLibPro;

class ModernGraphicsRenderer
{
    private \SplFileObject $stream;
    private bool $isDrawing = false;

    public function __construct(\SplFileObject $stream)
    {
        $this->stream = $stream;
    }

    // Этот метод должен быть вызван в начале рисования
    public function beginDraw(): void
    {
        if ($this->isDrawing) {
            throw new \LogicException("Drawing has already begun");
        }
        $this->stream->fwrite("<draw>\n");
        $this->isDrawing = true;
    }

    // Выполняет рисование линии
    public function drawLine(Point $start, Point $end, RGBColor $color): void
    {
        // TODO: выводит в output инструкцию для рисования линии в виде
        // <line fromX="3" fromY="5" toX="5" toY="17">
        //   <color r="0.35" g="0.47" b="1.0" a="1.0" />
        // </line>
        // Можно вызывать только между BeginDraw() и EndDraw()
    }

    // Этот метод должен быть вызван в конце рисования
    public function endDraw(): void
    {
        if (!$this->isDrawing) {
            throw new \LogicException("Drawing has not been started");
        }
        $this->stream->fwrite("</draw>\n");
        $this->isDrawing = false;
    }

    public function __destruct()
    {
        // Завершаем рисование, если оно было начато
        if ($this->isDrawing) {
            $this->endDraw();
        }
    }
}