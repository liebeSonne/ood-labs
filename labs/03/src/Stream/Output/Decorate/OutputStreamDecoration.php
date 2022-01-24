<?php

namespace App\Stream\Output\Decorate;

use App\Stream\Output\OutputDataStreamInterface;

class OutputStreamDecoration implements OutputDataStreamInterface
{
    private OutputDataStreamInterface $stream;

    public function __construct(OutputDataStreamInterface $stream)
    {
        $this->stream = $stream;
    }

    public function writeByte(string $data) : void
    {
        $this->stream->writeByte($data);
    }

    public function writeBlock(\SplFileObject $srcData, int $size) : void
    {
        $this->stream->writeBlock($srcData, $size);
    }
}