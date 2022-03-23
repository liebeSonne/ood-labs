<?php

namespace App\Command;

abstract class AbstractCommand implements CommandInterface
{
    private bool $executed = false;
    private bool $destroyed = false;

    abstract protected function doExecute(): void;

    abstract protected function doUnexecute(): void;

    public function execute(): void
    {
        if (!$this->executed && !$this->destroyed) {
            $this->doExecute();
            $this->executed = true;
        }
    }

    public function unexecute(): void
    {
        if ($this->executed && !$this->destroyed) {
            $this->doUnexecute();
            $this->executed = false;
        }
    }

    public function destroy(): void
    {
        if (!$this->destroyed) {
            $this->doDestroy();
            $this->destroyed = true;
        }
    }

    protected function doDestroy(): void
    {

    }
}