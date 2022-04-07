<?php

namespace App\Command;

abstract class AbstractCommand implements CommandInterface
{
    private bool $executed = false;

    abstract protected function doExecute(): void;

    public function execute(): void
    {
        if (!$this->executed) {
            $this->doExecute();
            $this->executed = true;
        }
    }
}