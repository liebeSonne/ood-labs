<?php

namespace App\Stream\Input;

class MemoryInputStream implements InputDataStreamInterface
{
    private \SplFileObject $stream;

    public function __construct()
    {
        $filename = 'php://memory';
        $this->stream = new \SplFileObject($filename, 'rb');
    }

    public function isEOF() : bool
    {
        return $this->stream->eof();
    }

    public function readByte() : string
    {
        $str = $this->stream->fread(1);
        if ($str === false) {
            throw new \Exception('Failure to read next byte');
        }
        return $str;
    }

    public function readBlock(\SplFileObject $dstBuffer, int $size) : int
    {
        $str = $this->stream->fread($size);
        if ($str === false) {
            throw new \Exception('Failure to read next byte');
        }
        file_put_contents($dstBuffer->getFilename(), $str);
        return $size;
    }
}