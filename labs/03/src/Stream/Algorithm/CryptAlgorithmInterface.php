<?php

namespace App\Stream\Algorithm;


interface CryptAlgorithmInterface
{
    public function encrypt(string $byte): string;
    public function decrypt(string $byte): string;
}