<?php

namespace App\Stream\Output;

class FileOutputStream implements OutputDataStreamInterface
{
    private \SplFileObject $stream;

    public function __construct(string $filename)
    {
        $this->stream = new \SplFileObject($filename, 'ab');
    }

    public function writeByte(string $data) : void
    {
        $result = $this->stream->fwrite($data);
        if ($result === false)
        {
            throw new \Exception('Failure to write');
        }
    }

    public function writeBlock(\SplFileObject $srcData, int $size) : void
    {
        $str = $srcData->fread($size);
        $result = $this->stream->fwrite($str);
        if ($result === false)
        {
            throw new \Exception('Failure to write');
        }
    }
}