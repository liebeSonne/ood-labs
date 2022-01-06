<?php

namespace App\Stream\Input;

class FileInputStream implements InputDataStreamInterface
{
    private $stream;

    public function __construct(string $filename)
    {
        if (!file_exists($filename)) {
            throw new \Exception('File not found: ' . $filename);
        }

        if (!is_readable($filename)) {
            throw new \Exception('File is not readable');
        }

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
            fwrite($dstBuffer, $str);
        }
        return $size;
    }

    public function __destruct()
    {
        fclose($this->stream);
    }
}