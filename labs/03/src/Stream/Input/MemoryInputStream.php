<?php

namespace App\Stream\Input;

class MemoryInputStream implements InputDataStreamInterface
{
    private $stream;

    public function __construct()
    {
        $filename = 'php://memory';
        $this->stream = fopen($filename, 'rb');
    }

    public function isEOF() : bool
    {
        return feof($this->stream);
    }

    public function readByte() : string
    {
        $str = fread($this->stream, 1);
        if ($str === false) {
            throw new \Exception('Failure to read next byte');
        }
        return $str;
    }

    public function readBlock($dstBuffer, int $size) : int
    {
        $str = fread($this->stream, $size);
        if ($str === false) {
            throw new \Exception('Failure to read next byte');
        }
        if ($dstBuffer) {
            file_put_contents($dstBuffer, $str);
        }
        return $size;
    }

    public function __destruct()
    {
        fclose($this->stream);
    }

}