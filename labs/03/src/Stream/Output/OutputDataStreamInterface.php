<?php

namespace App\Stream\Output;

interface OutputDataStreamInterface
{
    /**
     * Записывает в поток данных байт.
     * Выбрасывает исключение в случае ошибки.
     * @param string $data
     * @return void
     * @throws \Exception
     */
    public function writeByte(string $data) : void;

    /**
     * Записывает в поток блок данных размером size байт, располагающийся по адресу srcData.
     * Выбрасывает исключение в случае ошибки.
     * @param \SplFileObject $srcData
     * @param int $size
     * @return void
     * @throws \Exception
     */
    public function writeBlock(\SplFileObject $srcData, int $size) : void;
}