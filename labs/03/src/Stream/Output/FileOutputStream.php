<?php

namespace App\Stream\Output;

class FileOutputStream implements OutputDataStreamInterface
{
    private $stream;

    public function __construct(string $filename)
    {
        $this->stream = fopen($filename, 'ab');
    }

    public function writeByte(string $data) : void
    {
        $result = fwrite($this->stream, $data);
        if ($result === false)
        {
            throw new \Exception('Failure to write');
        }
    }

    public function writeBlock($srcData, int $size) : void
    {
        $str = fread($srcData, $size);
        $result = fwrite($this->stream, $str);
        if ($result === false)
        {
            throw new \Exception('Failure to write');
        }
    }

    public function __destruct()
    {
        fclose($this->stream);
    }
}