<?php

namespace App\Stream\Input;

class FileInputStream implements InputDataStreamInterface
{
    private \SplFileObject $stream;
    private $pos;

    public function __construct(string $filename)
    {
        if (!file_exists($filename)) {
            throw new \Exception('File not found: ' . $filename);
        }

        if (!is_readable($filename)) {
            throw new \Exception('File is not readable');
        }

        $this->stream = new \SplFileObject($filename, 'rb');
    }

    public function isEOF() : bool
    {
        return $this->stream->eof() || $this->pos >= $this->stream->getSize();
    }

    public function readByte() : string
    {
        $str = $this->stream->fread(1);
        $this->pos = $this->stream->ftell();
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
        $dstBuffer->fwrite($str);
        return $size;
    }
}