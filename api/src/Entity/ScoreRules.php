<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ScoreRulesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: '`score_rules`')]
#[ORM\Entity(repositoryClass: ScoreRulesRepository::class)]
class ScoreRules
{
    public const PHONE_TYPE = 'phone';
    public const EMAIL_TYPE = 'email';
    public const EDUCATION_TYPE = 'education';
    public const AGREEMENT_TYPE = 'agreement';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $name;

    #[ORM\Column(type: 'string', columnDefinition: "ENUM('phone', 'email', 'education', 'agreement') NOT NULL")]
    private string $type;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $value;

    #[ORM\Column(type: 'integer')]
    private int $score;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): void
    {
        $this->value = $value;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function setScore(int $score): void
    {
        $this->score = $score;
    }

}