<?php

namespace App\Command;

interface CommandInterface
{
    public function execute(): void;
    public function unexecute(): void;
    public function destroy(): void;
}