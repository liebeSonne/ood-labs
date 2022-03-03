<?php

namespace App\Stream\Algorithm;

class ReplaceCryptAlgorithm implements CryptAlgorithmInterface
{
    private int $seed;
    private array $encryptTable = [];
    private array $decryptTable = [];

    public function __construct($seed = 0)
    {
        $this->seed = $seed;
        $this->initTable();
    }

    private function initTable(): void
    {
        $encrypt = [];
        $decrypt = [];
        for ($i = 0; $i < 256; $i++) {
            $ch = chr($i);
            $encrypt[] = $ch;
            $decrypt[] = 0;
        }

        mt_srand($this->seed, MT_RAND_MT19937);
        shuffle($encrypt);

        for ($i = 0; $i < 256; $i++) {
            $index = ord($encrypt[$i]);
            $decrypt[$index] = chr($i);
        }

        $this->encryptTable = $encrypt;
        $this->decryptTable = $decrypt;
    }

    public function encrypt(string $byte): string
    {
        $index = ord($byte);
        return $this->encryptTable[$index];
    }

    public function decrypt(string $byte): string
    {
        $index = ord($byte);
        return $this->decryptTable[$index];
    }
}
