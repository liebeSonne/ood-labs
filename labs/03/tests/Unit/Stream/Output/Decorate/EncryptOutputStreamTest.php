<?php

namespace Tests\Unit\Stream\Output\Decorate;

use App\Stream\Algorithm\ReplaceCryptAlgorithm;
use App\Stream\Output\Decorate\EncryptOutputStream;
use App\Stream\Output\OutputDataStreamInterface;
use PHPUnit\Framework\TestCase;

class EncryptOutputStreamTest extends TestCase
{
    public function testWriteByte() : void
    {
        $output = $this->createMock(OutputDataStreamInterface::class);

        $seed = 0;
        $alg = new ReplaceCryptAlgorithm($seed);
        $stream = new EncryptOutputStream($output, $alg);

        $output->expects($this->once())->method('writeByte');

        $str = 'a';
        $stream->writeByte($str);
    }

    public function testWriteBlock() : void
    {
        $output = $this->createMock(OutputDataStreamInterface::class);

        $seed = 0;
        $alg = new ReplaceCryptAlgorithm($seed);
        $stream = new EncryptOutputStream($output, $alg);

        $size = 3;
        $output->expects($this->once())->method('writeBlock');

        $srcData = new \SplFileObject('php://temp','w+b');

        $stream->writeBlock($srcData, $size);
    }
}
