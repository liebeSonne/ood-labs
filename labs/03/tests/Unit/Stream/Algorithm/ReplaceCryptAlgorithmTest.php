<?php

namespace Tests\Unit\Stream\Algorithm;

use App\Stream\Algorithm\ReplaceCryptAlgorithm;
use PHPUnit\Framework\TestCase;

class ReplaceCryptAlgorithmTest extends TestCase
{
    public function testEncryptDecrypt(): void
    {
        $seed = 0;
        $alg = new ReplaceCryptAlgorithm($seed);

        $str = 'abcdefgh123';

        foreach (str_split($str) as $ch) {
            $encrypt = $alg->encrypt($ch);
            $decrypt = $alg->decrypt($encrypt);
            $this->assertEquals($ch, $decrypt);
        }
    }
}
