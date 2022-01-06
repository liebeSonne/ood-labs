<?php

namespace App\Stream\Output\Decorate;

use App\Stream\Output\OutputDataStreamInterface;

class EncryptOutputStream extends OutputStreamDecoration
{
    private array $table = [];

    public function __construct(OutputDataStreamInterface $stream, int $seed = 0)
    {
        parent::__construct($stream);

        $data = [];
        for($i = 0; $i < 256; $i++) {
            $ch = chr($i);
            $data[$i] = $ch;
        }

        mt_srand($seed, MT_RAND_MT19937);
        shuffle($data);

        $this->table = $data;
    }

    protected function getEncryptedByte(string $byte) : string
    {
        $index = ord($byte);
        return $this->table[$index];
    }

    public function writeByte(string $data) : void
    {
        $data = $this->getEncryptedByte($data);
        parent::writeByte($data);
    }

    public function writeBlock($srcData, int $size) : void
    {
        $data = fread($srcData, $size);
        $f = fopen('php://tmp', 'wb');
        foreach ($data as $ch) {
            $ch = $this->getEncryptedByte($ch);
            fwrite($f, $ch);
        }
        parent::writeBlock($f, $size);
    }
}