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

    $input = new FileInputStream($fileInput);
    $output = new FileOutputStream($fileOutput);

    for ($i = 1; $i < $countArg - 2; $i++) {

        switch ($argv[$i]) {
            case '--encrypt':
                $seed = (int)$argv[++$i];
                echo "--encrypt $seed\n";
                $output = new EncryptOutputStream($output, $seed);
                break;
            case '--decrypt':
                $seed = $argv[++$i];
                echo "--decrypt $seed\n";
                $input = new DecryptInputStream($input, $seed);
                break;
            case '--compress':
                echo "--compress\n";
                $output = new CompressOutputStream($output);
                break;
            case '--decompress':
                echo "--decompress\n";
                $input = new DecompressInputStream($input);
                break;
        }
    }

    while (!$input->isEOF()) {
        $byte = $input->readByte();
        $output->writeByte($byte);
    }

    echo "\n";
    echo "[end]\n";
    echo "input: " . file_get_contents($fileInput) . "\n";
    echo "output: " . file_get_contents($fileOutput) . "\n";
}

main($argv);
