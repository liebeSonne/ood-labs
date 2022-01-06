<?php

namespace App\Stream\Input;

interface InputDataStreamInterface
{
    /**
     * Возвращает признак достижения конца данных потока.
     * Выбрасывает исключение в случае ошибки.
     * @return bool
     * @throws \Exception
     */
    public function isEOF() : bool;

    /**
     * Считывает байт из потока.
     * Выбрасывает исключение в случае ошибки.
     * @return string
     * @throws \Exception
     */
    public function readByte() : string;

    /**
     * Считывает из потока блок данных размером size байт, записывая его в память по адресу dstBuffer.
     * Возвращает количество реально прочитанных байт.
     * Выбрасывает исключение в случае ошибки.
     * @param resource $dstBuffer
     * @param int $size
     * @return int
     * @throws \Exception
     */
    public function readBlock($dstBuffer, int $size) : int;
}