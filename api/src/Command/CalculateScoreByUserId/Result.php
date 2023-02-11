<?php

declare(strict_types=1);

namespace App\Command\CalculateScoreByUserId;

use App\Entity\ScoreRules;
use App\Entity\User;
use App\Interface\ResultInterface;

class Result implements ResultInterface
{
    /**
     * @var ScoreRules[]
     */
    public array $scoreRules;

    public User $user;

    public function __construct(array $scoreRules, User $user)
    {
        $this->scoreRules = $scoreRules;
        $this->user = $user;
    }
}