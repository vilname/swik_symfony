<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\ScoreRules;
use App\Entity\ScoreUsers;
use App\Entity\User;

class CalculateScoreService
{
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
}