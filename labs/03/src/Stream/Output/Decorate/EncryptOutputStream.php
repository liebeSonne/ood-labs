<?php

namespace App\Stream\Output\Decorate;

use App\Stream\Algorithm\CryptAlgorithmInterface;
use App\Stream\Output\OutputDataStreamInterface;

class EncryptOutputStream extends OutputStreamDecoration
{
    private CryptAlgorithmInterface $algorithm;

    public function __construct(OutputDataStreamInterface $stream, CryptAlgorithmInterface $algorithm)
    {
        parent::__construct($stream);
        $this->algorithm = $algorithm;
    }

    public function writeByte(string $data) : void
    {
        $data = $this->algorithm->encrypt($data);
        parent::writeByte($data);
    }

    public function writeBlock(\SplFileObject $srcData, int $size) : void
    {
        $data = $srcData->fread($size);
        $f = new \SplFileObject('php://temp', 'wb');
        foreach (str_split($data) as $ch) {
            $ch = $this->algorithm->encrypt($ch);
            $f->fwrite($ch);
        }
        parent::writeBlock($f, $size);
    }

    public function close(): void
    {
        parent::close();
    }
}