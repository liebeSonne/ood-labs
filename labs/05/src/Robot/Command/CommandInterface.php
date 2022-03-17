<?php

namespace App\Robot\Command;

interface CommandInterface
{
    public function execute(): void;
}