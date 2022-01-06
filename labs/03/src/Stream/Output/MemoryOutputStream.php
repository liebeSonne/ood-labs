<?php

namespace App\Stream\Output;

class MemoryOutputStream implements OutputDataStreamInterface
{
    private $stream;

    public function __construct()
    {
        $filename = 'php://memory';
        $this->stream = fopen($filename, 'ab');
    }

    public function writeByte(string $data) : void
    {
        fwrite($this->stream, $data);
    }

    public function writeBlock($srcData, int $size) : void
    {
        $f = fopen($srcData, 'rb');
        $str = fread($f, $size);
        fwrite($this->stream, $str);
    }

    public function __destruct()
    {
        fclose($this->stream);
    }
}