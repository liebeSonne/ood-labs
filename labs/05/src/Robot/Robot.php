<?php

namespace App\Robot;

//enum WalkDirection
//{
//    case North;
//    case South;
//    case West;
//    case East;
//}

class Robot
{
    public const WALK_NORTH = 'north';
    public const WALK_SOUTH = 'south';
    public const WALK_WEST = 'west';
    public const WALK_EAST = 'east';

    private array $directionToString = [
        self::WALK_EAST => 'east',
        self::WALK_SOUTH => 'south',
        self::WALK_WEST => 'west',
        self::WALK_NORTH => 'north',
    ];

    private bool $isTurnedOn = false;
    private ?string $direction = null;

    public function turnOn(): void
    {
        if (!$this->isTurnedOn) {
            $this->isTurnedOn = true;
            echo "It am waiting for your commands\n";
        }
    }

    public function turnOff(): void
    {
        if ($this->isTurnedOn) {
            $this->isTurnedOn = false;
            $this->direction = null;
            echo "It is a pleasure to serve you\n";
        }
    }

    public function walk(string $direction): void
    {
        if ($this->isTurnedOn) {
            $this->direction = $direction;

            echo "Walking " . $this->directionToString[$direction]. "\n";

        } else {
            echo "The robot should be turned on first\n";
        }
    }

    public function stop(): void
    {
        if ($this->isTurnedOn) {
            if ($this->direction) {
                $this->direction = null;
                echo "Stopped\n";
            } else {
                echo "I am staying still\n";
            }
        } else {
            echo "The robot should be turned on first\n";
        }
    }
}