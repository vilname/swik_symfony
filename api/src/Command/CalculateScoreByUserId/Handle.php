<?php

declare(strict_types=1);

namespace App\Command\CalculateScoreByUserId;

use App\Entity\ScoreUsers;
use App\Entity\User;
use App\Interface\HandleInterface;
use App\Interface\CommandInterface;
use App\Repository\ScoreRulesRepository;
use App\Repository\ScoreUsersRepository;
use App\Repository\UserRepository;
use App\Helper\SubstringHelper;
use App\Service\CalculateScoreService;
use Doctrine\ORM\EntityManagerInterface;
use Throwable;
use Exception;

class Handle implements HandleInterface
{
    public function __construct(
        private UserRepository $userRepository,
        private ScoreRulesRepository $scoreRulesRepository,
        private ScoreUsersRepository $scoreUsersRepository,
        private EntityManagerInterface $entityManager,
        private CalculateScoreService $calculateScoreService
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

            $phoneCode = SubstringHelper::getPhoneCode($user->getPhone());
            $emailCode = SubstringHelper::getEmailCode($user->getEmail());
            $educationCode = $user->getEducationType()->getType();
            $isAgreement = $user->isAgreement();

            $scoreRules = $this->scoreRulesRepository->getScoreByValues($phoneCode, $emailCode, $educationCode, $isAgreement);

            $scoreUser = $this->scoreUsersRepository->findOneBy(['user' => $user]);
            if (is_null($scoreUser)) {
                $scoreUser = new ScoreUsers();
            }

            $scoreUser = $this->calculateScoreService->addScoreUser($scoreRules, $scoreUser, $user);
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