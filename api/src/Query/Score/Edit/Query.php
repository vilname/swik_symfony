<?php

declare(strict_types=1);

namespace App\Query\Score\Edit;

use App\Repository\UserRepository;

class Query
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    public function handle(int $id)
    {
        return $this->userRepository->find($id);
    }
}