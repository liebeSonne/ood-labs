<?php

namespace App\Stream\Input\Decorate;

use App\Stream\Algorithm\CryptAlgorithmInterface;
use App\Stream\Input\InputDataStreamInterface;

class DecryptInputStream extends InputStreamDecoration
{
    private CryptAlgorithmInterface $algorithm;

    public function __construct(InputDataStreamInterface $stream, CryptAlgorithmInterface $algorithm)
    {
        parent::__construct($stream);
        $this->algorithm = $algorithm;
    }

    public function readByte() : string
    {
        $byte = parent::readByte();
        $byte = $this->algorithm->decrypt($byte);
        return $byte;
    }

    public function readBlock(\SplFileObject $dstBuffer, int $size) : int
    {
        $position = $dstBuffer->ftell();
        $count = parent::readBlock($dstBuffer, $size);
        $buffer = [];
        for ($i = 0; $i < $count; $i++) {
            $ch = $dstBuffer->fread(1);
            $ch = $this->algorithm->decrypt($ch);;
            $buffer[$i] = $ch;
        }
        $dstBuffer->fseek($position);
        for ($i = 0; $i < $count; $i++) {
            $ch = $buffer[$i];
            $dstBuffer->fwrite($ch);
        }
        return $count;
    }
}