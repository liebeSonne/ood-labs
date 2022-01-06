<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Stream\Input\FileInputStream;
use App\Stream\Output\FileOutputStream;
use App\Stream\Output\Decorate\EncryptOutputStream;
use App\Stream\Input\Decorate\DecryptInputStream;
use App\Stream\Output\Decorate\CompressOutputStream;
use App\Stream\Input\Decorate\DecompressInputStream;

function main($argv)
{
    $countArg = count($argv);

    $fileInput = $argv[$countArg - 2];
    $fileOutput = $argv[$countArg - 1];

    echo "\n[begin]\n";
    echo "input: " . file_get_contents($fileInput) . "\n";
    echo "output: " . file_get_contents($fileOutput) . "\n";
    echo "\n";

    for ($i = 1; $i < $countArg - 2; $i++) {

        switch ($argv[$i]) {
            case '--encrypt':
                $seed = (int)$argv[++$i];
                echo "--encrypt $seed\n";
                $input = new FileInputStream($fileInput);
                $output = new FileOutputStream($fileOutput);
                $encrypt = new EncryptOutputStream($output, $seed);
                while (!$input->isEOF()) {
                    $byte = $input->readByte();
                    $encrypt->writeByte($byte);
                }
                unset($input);
                unset($output);
                break;
            case '--decrypt':
                $seed = $argv[++$i];
                echo "--decrypt $seed\n";
                $input = new FileInputStream($fileInput);
                $output = new FileOutputStream($fileOutput);
                $decrypt = new DecryptInputStream($input, $seed);
                while (!$decrypt->isEOF()) {
                    $byte = $decrypt->readByte();
                    $output->writeByte($byte);
                }
                break;
            case '--compress':
                echo "--compress\n";
                $input = new FileInputStream($fileInput);
                $output = new FileOutputStream($fileOutput);
                $compress = new CompressOutputStream($output);
                while (!$input->isEOF()) {
                    $byte = $input->readByte();
                    $compress->writeByte($byte);
                }
                break;
            case '--decompress':
                echo "--decompress\n";
                $input = new FileInputStream($fileInput);
                $output = new FileOutputStream($fileOutput);
                $decompress = new DecompressInputStream($input);
                while (!$decompress->isEOF()) {
                    $byte = $decompress->readByte();
                    $output->writeByte($byte);
                }
                break;
        }
    }

    echo "\n";
    echo "[end]\n";
    echo "input: " . file_get_contents($fileInput) . "\n";
    echo "output: " . file_get_contents($fileOutput) . "\n";
}

main($argv);