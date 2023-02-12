<?php

declare(strict_types=1);

namespace App\Command\Score\List;

use App\Common\ResultPagination;
use App\Interface\CommandInterface;
use App\Interface\HandleInterface;
use App\Repository\UserRepository;
use Throwable;
use Exception;

class Handle implements HandleInterface
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    /**
     * @param Command $command
     * @throws Exception
     */
    public function handle(CommandInterface $command): Result
    {
        try {
            $query = $this->userRepository->getQueryList();

            $users = $this->userRepository->getUsersByLimit($query, $command->pageSize, ($command->page - 1) * $command->pageSize);
            $countRows = $this->userRepository->getCountRowInQuery($query);

            return new Result($users, new ResultPagination($command->pageSize, $command->page, (int)ceil($countRows / $command->pageSize)));
        } catch (Throwable $e) {
            throw new Exception($e->getMessage());
        }
    }
}