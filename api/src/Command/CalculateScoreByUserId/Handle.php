<?php

declare(strict_types=1);

namespace App\Command\CalculateScoreByUserId;

use App\Entity\User;
use App\Interface\HandleInterface;
use App\Interface\CommandInterface;
use App\Repository\UserRepository;
use App\Service\CalculateScoreService;
use Doctrine\ORM\EntityManagerInterface;
use Throwable;
use Exception;

class Handle implements HandleInterface
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly EntityManagerInterface $entityManager,
        private readonly CalculateScoreService $calculateScoreService
    ) {
    }

    /**
     * @param Command $command
     * @throws Exception
     */
    public function handle(CommandInterface $command): Result
    {
        try {
            /** @var User $user */
            $user = $this->userRepository->find($command->userId);

            $scoreRules = $this->calculateScoreService->getScoreRules($user);
            $scoreUser = $this->calculateScoreService->getScoreUser($user, $scoreRules);

            $this->entityManager->persist($scoreUser);

            $user->setScore($scoreUser);

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            return new Result($scoreRules, $user);
        } catch (Throwable $e) {
            throw new Exception($e->getMessage());
        }
    }
}