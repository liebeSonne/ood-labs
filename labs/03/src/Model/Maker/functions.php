<?php

/**
 * Функция, возвращающая функцию, создающую коричную добавку
 */
function makeCinnamon(\App\Model\Beverage\BeverageInterface $beverage) : \App\Model\Beverage\BeverageInterface
{
    return new \App\Model\Condiment\Cinnamon($beverage);
};

/*
Возвращает функцию, декорирующую напиток определенной добавкой

Параметры шаблона:
	Condiment - класс добавки, конструктор которого в качестве первого аргумента
				принимает BeverageInterface оборачиваемого напитка
	Args - список типов прочих параметров конструктора (возможно, пустой)
*/
function makeCondiment(string $Condiment, ...$args) : callable
{
    return static function (\App\Model\Beverage\BeverageInterface $beverage) use ($Condiment, $args) {
        return new $Condiment($beverage, ...$args);
    };
};

