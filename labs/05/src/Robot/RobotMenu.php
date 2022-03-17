<?php

namespace App\Robot;

use App\Command\Menu\MenuExitCommand;
use App\Command\Menu\MenuHelpCommand;
use App\Robot\Menu\Menu;
use App\Robot\Command\BeginMacroCommand;
use App\Robot\Command\MacroCommand;
use App\Robot\Command\StopCommand;
use App\Robot\Command\TurnOffCommand;
use App\Robot\Command\TurnOnCommand;
use App\Robot\Command\WalkCommand;

class RobotMenu
{
    private $stream;
    private Menu $menu;
    private Robot $robot;

    public function __construct($stream = STDIN)
    {
        $this->robot = new Robot();
        $this->stream = $stream;
        $this->menu = new Menu($this->stream);

        $this->menu->addItem('on', 'Turns the Robot on', new TurnOnCommand($this->robot));
        $this->menu->addItem('off', 'Turns the Robot off', new TurnOffCommand($this->robot));
        $this->menu->addItem('north', 'Makes the Robot walk north', new WalkCommand($this->robot, Robot::WALK_NORTH));
        $this->menu->addItem('south', 'Makes the Robot walk south', new WalkCommand($this->robot, Robot::WALK_SOUTH));
        $this->menu->addItem('west', 'Makes the Robot walk west', new WalkCommand($this->robot, Robot::WALK_WEST));
        $this->menu->addItem('east', 'Makes the Robot walk east', new WalkCommand($this->robot, Robot::WALK_EAST));

        $cmd = new MacroCommand();
        $cmd->addCommand(new TurnOnCommand($this->robot));
        $cmd->addCommand(new WalkCommand($this->robot, Robot::WALK_NORTH));
        $cmd->addCommand(new WalkCommand($this->robot, Robot::WALK_EAST));
        $cmd->addCommand(new WalkCommand($this->robot, Robot::WALK_SOUTH));
        $cmd->addCommand(new WalkCommand($this->robot, Robot::WALK_WEST));
        $cmd->addCommand(new TurnOffCommand($this->robot));

        $this->menu->addItem('patrol', 'Patrol the territory', $cmd);

        $this->menu->addItem('stop', 'Stop the Robot', new StopCommand($this->robot));

        $this->menu->addItem('begin_macro', 'Begin record macro command.', new BeginMacroCommand($this->menu, $this->stream));
        $this->menu->addItem('help', 'Show instructions', new MenuHelpCommand($this->menu));
        $this->menu->addItem('exit', 'Exit from this menu', new MenuExitCommand($this->menu));

        $this->menu->showInstructions();
        $this->menu->run();
    }
}