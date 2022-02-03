<?php

namespace Tests\Unit\Command\Document;

use App\Command\Document\ChangeStringCommand;
use PHPUnit\Framework\TestCase;

class ChangeStringCommandTest extends TestCase
{
    public function testDoExecute(): void
    {
        $target = 'title';
        $newValue = 'newTitle';

        $command = new ChangeStringCommand($target, $newValue);

        $command->doExecute();

        $this->assertEquals($target, $newValue);
    }

    public function testDoUnexecute(): void
    {
        $target = 'title';
        $newValue = 'newTitle';
        $oldValue = $target;

        $command = new ChangeStringCommand($target, $newValue);

        $command->doUnexecute();

        $this->assertEquals($target, $oldValue);
    }

    public function testDoUnexecuteAfterExecute(): void
    {
        $target = 'title';
        $newValue = 'newTitle';
        $oldValue = $target;

        $command = new ChangeStringCommand($target, $newValue);

        $command->doExecute();
        $command->doUnexecute();

        $this->assertEquals($target, $oldValue);
    }
}