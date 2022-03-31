<?php

namespace Tests\Unit\App;

use App\App\Adapter\CanvasModernClassAdapter;
use App\ModernGraphicsLib\Point;
use PHPUnit\Framework\TestCase;

class CanvasModernClassAdapterTest extends TestCase
{
    public function testMoveToLineTo(): void
    {
        $filename = 'test.tmp';
        file_put_contents($filename, '');
        $stream = new \SplFileObject($filename, 'w+');

        $x1 = 10;
        $y1 = 20;
        $x2 = 50;
        $y2 = 70;
        $x3 = 100;
        $y3 = 120;

        $adapter = new CanvasModernClassAdapter($stream);

        $output = "";
        $output .= "<draw>\n";
        $output .= '(  <line fromX="' . $x1 . '" fromY="' . $y1 . '" toX="' . $x2 . '" toY="' . $y2 . '"/>)' . "\n";
        $output .= '(  <line fromX="' . $x2 . '" fromY="' . $y2 . '" toX="' . $x3 . '" toY="' . $y3 . '"/>)' . "\n";
        $output .= '(  <line fromX="' . $x1 . '" fromY="' . $y1 . '" toX="' . $x3 . '" toY="' . $y3 . '"/>)' . "\n";
        $output .= "</draw>\n";

        $adapter->beginDraw();
        $adapter->moveTo($x1, $y1);
        $adapter->lineTo($x2, $y2);
        $adapter->lineTo($x3, $y3);
        $adapter->moveTo($x1, $y1);
        $adapter->lineTo($x3, $y3);
        $adapter->endDraw();

        $this->assertEquals($output, file_get_contents($filename));

        unlink($filename);
    }
}