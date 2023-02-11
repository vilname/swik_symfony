<?php

declare(strict_types=1);

namespace App\Command\CalculateScoreByUserId;

use App\Interface\CommandInterface;

class Command implements CommandInterface
{
    public int $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }
}