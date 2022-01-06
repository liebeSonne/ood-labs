<?php

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../lib/make.functions.php';

use App\Model\Beverage\BeverageInterface;
use App\Model\Beverage\Coffee;
use App\Model\Beverage\Tea;
use App\Model\Condiment\Lemon;
use App\Model\Condiment\Cinnamon;
use App\Model\Beverage\Latte;
use App\Model\Condiment\IceCubes;
use App\Model\Condiment\IceCubeType;
use App\Model\Condiment\ChocolateCrumbs;

function dialogWithUser() : void
{
    echo "Type 1 for coffee or 2 for tea\n";

    /**
     * @var int
     */
    $beverageChoice = (int) fgets(STDIN);

    /**
     * @var BeverageInterface
     */
    $beverage = null;

    if ($beverageChoice == 1) {
        $beverage = new Coffee();
    } elseif ($beverageChoice == 2) {
        $beverage = new Tea();
    } else {
        return;
    }

    /**
     * @var int
     */
    $condimentChoice = 0;

    for (;;)
    {
        echo "1 - Lemon, 2 - Cinnamon, 0 - Checkout\n";
        $condimentChoice = (int) fgets(STDIN);

        if ($condimentChoice == 1) {
            $beverage = new Lemon($beverage, 2);
        } elseif ($condimentChoice == 2) {
            $beverage = new Cinnamon($beverage);
        } elseif ($condimentChoice == 0) {
            break;
        } else {
            return;
        }

    }

    echo $beverage->getDescription() . ', cost: ' . $beverage->getCost() . "\n";
}

function main() : void
{
    dialogWithUser();
    echo "\n";
    {
        // Наливаем чашечку латте
        $latte = new Latte();
        // добавляем корицы
        $cinnamon = new Cinnamon($latte);
        // добавляем пару долек лимона
        $lemon = new Lemon($cinnamon, 2);
        // добавляем пару кубиков льда
        $iceCubes = new IceCubes($lemon, 2, IceCubes::DRY);
        // добавляем 2 грамма шоколадной крошки
        $beverage = new ChocolateCrumbs($iceCubes, 2);

        // Выписываем счет покупателю
        echo $beverage->getDescription() . ' costs ' . $beverage->getCost() . "\n";
    }

    {
        $beverage = new ChocolateCrumbs(  // Внешний слой: шоколадная крошка
            new IceCubes(                 // | под нею - кубики льда
                new Lemon(                // | | еще ниже лимон
                    new Cinnamon(         // | | | слоем ниже - корица
                        new Latte()       // | | |   в самом сердце - Латте
                    ),
        2),                       // | | 2 дольки лимона
    2, IceCubes::DRY),    // | 2 кубика сухого льда
    2);                              // 2 грамма шоколадной крошки

        echo $beverage->getDescription() . ' costs ' . $beverage->getCost() . "\n";
    }

    // Подробнее рассмотрим работу makeCondiment
    {
        // lemon - функция, добавляющая "2 дольки лимона" к любому напитку
        $lemon2 = makeCondiment(\App\Model\Condiment\Lemon::class, 2);
        // iceCubes - функция, добавляющая "3 кусочка льда" к любому напитку
        $iceCubes3 = makeCondiment(\App\Model\Condiment\IceCubes::class, 3, IceCubes::WATER);

        $tea = new Tea();

        // декорируем чай двумя дольками лимона и тремя кусочками льда
        $lemonIceTea = $iceCubes3($lemon2($tea));
        /* Предыдущая строка выполняет те же действия, что и следующий код:
        $lemonIceTea =
            IceCubes(
                Leamon(
                    $tea,
                2),
            2, IceCube::WATER);
        */

        echo $lemonIceTea->getDescription() . ' costs ' . $lemonIceTea->getCost() . "\n";
    }

}

main();
