<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\ScoreRules;
use App\Entity\ScoreUsers;
use App\Entity\User;
use App\Helper\SubstringHelper;
use App\Repository\ScoreRulesRepository;
use App\Repository\ScoreUsersRepository;

class CalculateScoreService
{
    public function __construct(
        private readonly ScoreRulesRepository $scoreRulesRepository,
        private readonly ScoreUsersRepository $scoreUsersRepository,
    ) {
    }

    public function addScoreUser(array $scoreRules, ScoreUsers $scoreUser, User $user): ScoreUsers
    {
        $scoreTotal = 0;

        /** @var ScoreRules $scoreRule */
        foreach ($scoreRules as $scoreRule) {
            $scoreTotal += $scoreRule->getScore();

            switch ($scoreRule->getType()) {
                case ScoreRules::PHONE_TYPE:
                    $scoreUser->setPhoneScore($scoreRule->getScore());
                    break;
                case ScoreRules::EMAIL_TYPE:
                    $scoreUser->setEmailScore($scoreRule->getScore());
                    break;
                case ScoreRules::EDUCATION_TYPE:
                    $scoreUser->setEducationScore($scoreRule->getScore());
                    break;
                case ScoreRules::AGREEMENT_TYPE:
                    $scoreUser->setAgreementScore($scoreRule->getScore());
                    break;
                default:
            }
        }

        $scoreUser->setUser($user);
        $scoreUser->setTotalScore($scoreTotal);

        return $scoreUser;
    }

    /**
     * @return ScoreRules[] array
     */
    public function getScoreRules(User $user): array
    {
        $phoneCode = SubstringHelper::getPhoneCode($user->getPhone());
        $emailCode = SubstringHelper::getEmailCode($user->getEmail());
        $educationCode = $user->getEducationType()->getType();
        $isAgreement = $user->isAgreement();

        return $this->scoreRulesRepository->getScoreByValues($phoneCode, $emailCode, $educationCode, $isAgreement);
    }

    /**
     * @param ScoreRules[] $scoreRules
     */
    public function getScoreUser(User $user, array $scoreRules): ScoreUsers
    {
        $scoreUser = $this->scoreUsersRepository->findOneBy(['user' => $user]);
        if (is_null($scoreUser)) {
            $scoreUser = new ScoreUsers();
        }

        return $this->addScoreUser($scoreRules, $scoreUser, $user);
    }
}