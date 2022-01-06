<?php

namespace App\Stream\Input\Decorate;

use App\Stream\Input\InputDataStreamInterface;

class DecryptInputStream extends InputStreamDecoration
{
    private array $table = [];

    public function __construct(InputDataStreamInterface $stream, int $seed = 0)
    {
        parent::__construct($stream);

        $encrypt = [];
        $decrypt = [];
        for($i = 0; $i < 256; $i++) {
            $ch = chr($i);
            $encrypt[] = $ch;
            $decrypt[] = 0;
        }

        mt_srand($seed, MT_RAND_MT19937);
        shuffle($encrypt);

        for($i =0; $i < 256; $i++) {
            $index = ord($encrypt[$i]);
            $decrypt[$index] = chr($i);
        }
        $this->table = $decrypt;
    }

    protected function getDecryptedByte(string $byte) : string
    {
        $index = ord($byte);
        return $this->table[$index];
    }

    public function readByte() : string
    {
        $byte = parent::readByte();
        $byte = $this->getDecryptedByte($byte);
        return $byte;
    }

    public function readBlock($dstBuffer, int $size) : int
    {
        $position = ftell($dstBuffer);
        $count = parent::readBlock($dstBuffer, $size);
        $buffer = [];
        for ($i = 0; $i < $count; $i++) {
            $ch = fread($dstBuffer, 1);
            $ch = $this->getDecryptedByte($ch);
            $buffer[$i] = $ch;
        }
        fseek($dstBuffer, $position);
        for ($i = 0; $i < $count; $i++) {
            $ch = $buffer[$i];
            fwrite($dstBuffer, $ch);
        }
        return count;
    }
}