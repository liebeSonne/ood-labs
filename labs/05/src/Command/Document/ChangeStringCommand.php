<?php

namespace App\Command\Document;

use App\Command\AbstractCommand;

class ChangeStringCommand extends AbstractCommand
{
    private string $target;
    private string $newValue;
    private string $oldValue;

    public function __construct(string &$target, string $newValue)
    {
        $this->target =& $target;
        $this->newValue = $newValue;
        $this->oldValue = $target;
    }

    public function doExecute(): void
    {
        $this->target = $this->newValue;
    }

    public function doUnexecute(): void
    {
        $this->target = $this->oldValue;
    }
}