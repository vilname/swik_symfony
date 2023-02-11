<?php

declare(strict_types=1);

namespace App\Command\CalculateScore;

use App\Entity\User;
use App\Interface\CommandInterface;
use App\Interface\HandleInterface;
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
     * @return Result[]
     * @throws Exception
     */
    public function handle(?CommandInterface $command = null): array
    {
        try {
            $result = [];
            $users = $this->userRepository->findBy(['score' => null]);

            /** @var User $user */
            foreach ($users as $user) {
                $scoreRules = $this->calculateScoreService->getScoreRules($user);
                $scoreUser = $this->calculateScoreService->getScoreUser($user, $scoreRules);
                $this->entityManager->persist($scoreUser);

                $user->setScore($scoreUser);
                $this->entityManager->persist($user);

                $result[] = new Result($scoreRules, $user);
            }

            $this->entityManager->flush();

            return $result;
        } catch (Throwable $e) {
            throw new Exception($e->getMessage());
        }

    }
}