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
    public function drawLine(Point $start, Point $end, RGBAColor $color): void
    {
        if (!$this->isDrawing) {
            throw new \LogicException("rawLine is allowed between BeginDraw()/EndDraw() only");
        }

        $str = '<line fromX="%d" fromY="%d" toX="%d" toY="%d">' . "\n";
        $str .= '   <color r="%.2f" g="%.2f" b="%.2f" a="%.2f" />' . "\n";
        $str .= '</line>';
        $str = sprintf($str, $start->x, $start->y, $end->x, $end->y, $color->r, $color->g,$color->b, $color->a);
        $this->stream->fwrite($str);
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