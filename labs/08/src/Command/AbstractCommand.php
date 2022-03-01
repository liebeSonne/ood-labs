<?php

namespace App\Command;

abstract class AbstractCommand implements CommandInterface
{
    private bool $executed = false;

    abstract protected function doExecute(): void;

    abstract protected function doUnexecute(): void;

    public function execute(): void
    {
        if (!$this->executed) {
            $this->doExecute();
            $this->executed = true;
        }
    }

    public function unexecute(): void
    {
        if ($this->executed) {
            $this->doUnexecute();
            $this->executed = false;
        }
    }
}