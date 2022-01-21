<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Stream\Input\FileInputStream;
use App\Stream\Output\FileOutputStream;
use App\Stream\Output\Decorate\EncryptOutputStream;
use App\Stream\Input\Decorate\DecryptInputStream;
use App\Stream\Output\Decorate\CompressOutputStream;
use App\Stream\Input\Decorate\DecompressInputStream;
use App\Stream\Input\InputDataStreamInterface;
use App\Stream\Output\OutputDataStreamInterface;

function readWrite(InputDataStreamInterface $input, OutputDataStreamInterface $output)
{
    while (!$input->isEOF()) {
        $byte = $input->readByte();
        $output->writeByte($byte);
    }
}

function readWriteFiles(string $in, string $out)
{
    $fi = new FileInputStream($in);
    $fo = new FileOutputStream($out);
    readWrite($fi, $fo);
}

function copyClear($from, $to): void
{
    file_put_contents($to,'');
    readWriteFiles($from, $to);
    file_put_contents($from,'');
}

function main($argv, $show_content = false)
{
    $countArg = count($argv);

    $fileInput = $argv[$countArg - 2] ?? null;
    $fileOutput = $argv[$countArg - 1] ?? null;

    if ($fileInput === null) {
        echo "Error: Input file not specified\n";
        return;
    }
    if ($fileOutput === null) {
        echo "Error: Output file not specified\n";
        return;
    }

    echo "\n[begin]\n";
    if ($show_content) {
        echo "input: " . file_get_contents($fileInput) . "\n";
        echo "output: " . @file_get_contents($fileOutput) . "\n";
        echo "\n";
    }

    $fileTmp = 'file.tmp';
    file_put_contents($fileTmp,'');
    readWriteFiles($fileInput, $fileTmp);

    for ($i = 1; $i < $countArg - 2; $i++) {

        $input = new FileInputStream($fileTmp);
        $output = new FileOutputStream($fileOutput);

        switch ($argv[$i]) {
            case '--encrypt':
                $seed = (int) $argv[++$i];
                echo "--encrypt $seed\n";
                $output = new EncryptOutputStream($output, $seed);
                readWrite($input, $output);
                copyClear($fileOutput, $fileTmp);
                break;
            case '--decrypt':
                $seed = (int) $argv[++$i];
                echo "--decrypt $seed\n";
                $input = new DecryptInputStream($input, $seed);
                readWrite($input, $output);
                copyClear($fileOutput, $fileTmp);
                break;
            case '--compress':
                echo "--compress\n";
                $output = new CompressOutputStream($output);
                readWrite($input, $output);
                copyClear($fileOutput, $fileTmp);
                break;
            case '--decompress':
                echo "--decompress\n";
                $input = new DecompressInputStream($input);
                readWrite($input, $output);
                copyClear($fileOutput, $fileTmp);
                break;
        }
    }

    readWriteFiles($fileTmp, $fileOutput);

    echo "\n";
    echo "[end]\n";
    if ($show_content) {
        echo "input: '" . file_get_contents($fileInput) . "'\n";
        echo "output: '" . file_get_contents($fileOutput) . "'\n";
    }
}

$show_content = true;
main($argv, $show_content);

