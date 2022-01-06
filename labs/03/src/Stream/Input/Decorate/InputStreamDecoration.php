<?php

namespace App\Stream\Input\Decorate;

use App\Stream\Input\InputDataStreamInterface;

class InputStreamDecoration implements InputDataStreamInterface
{
    private InputDataStreamInterface $stream;

    public function __construct(InputDataStreamInterface $stream)
    {
        $this->stream = $stream;
    }

    public function isEOF() : bool
    {
        return $this->stream->isEOF();
    }

    public function readByte() : string
    {
        return $this->stream->readByte();
    }

    public function readBlock($dstBuffer, int $size) : int
    {
        return $this->stream->readBlock($dstBuffer, $size);
    }
}