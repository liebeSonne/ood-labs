<?php

namespace App;

use App\Canvas\SVGCanvas;
use App\Shape\Ellipse;
use App\Shape\Group\GroupShape;
use App\Shape\Rect;
use App\Shape\Rectangle;
use App\Shape\Triangle;
use App\Slide\Slide;
use App\Canvas\Canvas;
use App\Style\RGBAColor;
use App\Style\StyleFill;
use App\Style\StyleStroke;

class App
{
    public function main(): void
    {
        $width = 1024;
        $height = 486;

        $sky = new Rectangle(
            new Rect(
                0,
                0,
                $width,
                $height / 2 - 20
            ),
            new StyleStroke(new RGBAColor(0x3692D700), 1),
            new StyleFill(new RGBAColor(0x3692D7DB))
        );
        $ground = new Rectangle(
            new Rect(
                0,
                $height / 2 - 20,
                $width,
                $height / 2 + 20,
            ),
            new StyleStroke(new RGBAColor(0x785527FF), 1),
            new StyleFill(new RGBAColor(0x5c421eFF))
        );
        $background = new GroupShape();
        $background->insertShape($sky, 0);
        $background->insertShape($ground, 1);

        $walls = new Rectangle(
            new Rect(
                $width / 2 - 100,
                $height / 2 - 50,
                200,
                100
            ),
            new StyleStroke(new RGBAColor(0x0E106AFF), 1),
            new StyleFill(new RGBAColor(0x0E106AEE))
        );
        $window = new Rectangle(
            new Rect(
                $width / 2 - 60,
                $height / 2 - 30,
                40,
                40
            ),
            new StyleStroke(new RGBAColor(0x763209FF), 1),
            new StyleFill(new RGBAColor(0x4CDDFFFF))
        );
        $coverage = new Triangle(
            new Rect(
                $width / 2 - 105,
                $height / 2 - 100,
                210,
                50
            ),
            new StyleStroke(new RGBAColor(0xA52A2AFF), 2),
            new StyleFill(new RGBAColor(0xA52A2AFE))
        );
        $tube = new Rectangle(
            new Rect(
                $width / 2 + 40,
                $height / 2 - 100,
                20,
                40
            ),
            new StyleStroke(new RGBAColor(0x87240CCC), 1),
            new StyleFill(new RGBAColor(0x87240CFF))
        );
        $roof = new GroupShape();
        $roof->insertShape($tube, 0);
        $roof->insertShape($coverage, 1);

        $house = new GroupShape();
        $house->insertShape($walls, 0);
        $house->insertShape($window, 1);
        $house->insertShape($roof, 2);

        $sun = new Ellipse(
            new Rect(
                $width / 2 + 150,
                $height / 2 - 150,
                50,
                50
            ),
            new StyleStroke(new RGBAColor(0xFFFF0000), 1),
            new StyleFill(new RGBAColor(0xFFFF0077))
        );

        $shapes = new GroupShape();
        $shapes->insertShape($background, 0);
        $shapes->insertShape($house, 1);
        $shapes->insertShape($sun, 2);

        $slide = new Slide($width, $height, $shapes);
//        $canvas = new Canvas();

//        $stream = new \SplFileObject('php://stdout', 'w+');
        $stream = new \SplFileObject("/app/data/1.svg", 'w+');
        $canvas = new SVGCanvas($stream, $width, $height);

        $slide->draw($canvas);
    }
}