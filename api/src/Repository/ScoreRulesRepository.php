<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\ScoreRules;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class ScoreRulesRepository extends EntityRepository
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, $em->getClassMetadata(ScoreRules::class));
    }

    public function getScoreByValues(int $phoneCode, string $emailCode, string $educationCode, bool $isAgreement): array
    {
        return $this->createQueryBuilder('score_rules')
            ->where('score_rules.type = :phoneType AND score_rules.value = :phoneValue')
            ->orWhere('score_rules.type = :emailType AND score_rules.value = :emailValue')
            ->orWhere('score_rules.type = :educationType AND score_rules.value = :educationValue')
            ->orWhere('score_rules.type = :agreementType AND score_rules.value = :agreementValue')
            ->setParameters([
                'phoneType' => ScoreRules::PHONE_TYPE,
                'phoneValue' => $phoneCode,
                'emailType' => ScoreRules::EMAIL_TYPE,
                'emailValue' => $emailCode,
                'educationType' => ScoreRules::EDUCATION_TYPE,
                'educationValue' => $educationCode,
                'agreementType' => ScoreRules::AGREEMENT_TYPE,
                'agreementValue' => $isAgreement
            ])
            ->getQuery()
            ->getResult();
    }
}
