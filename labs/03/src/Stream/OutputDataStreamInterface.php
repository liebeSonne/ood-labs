<?php

namespace App\Stream;

interface OutputDataStreamInterface
{
    /**
     * Записывает в поток данных байт.
     * Выбрасывает исключение в случае ошибки.
     * @param string $data
     * @return void
     */
    public function writeByte(string $data) : void;

    /**
     * Записывает в поток блок данных размером size байт, располагающийся по адресу srcData.
     * Выбрасывает исключение в случае ошибки.
     * @param resource $srcData
     * @param int $size
     * @return void
     */
    public function writeBlock($srcData, int $size) : void;
}