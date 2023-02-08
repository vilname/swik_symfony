<?php

declare(strict_types=1);

namespace App\Interfaces;

interface CommandHandleInterface
{
    public function handle(CommandInterface $command);
}