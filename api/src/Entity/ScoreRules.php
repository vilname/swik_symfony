<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ScoreRulesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: '`score_rules`')]
#[ORM\Entity(repositoryClass: ScoreRulesRepository::class)]
class ScoreRules
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string')]
    private string $name;

    #[ORM\Column(type: 'string', columnDefinition: "ENUM('phone', 'email', 'education', 'agreement')")]
    private string $type;

    #[ORM\Column(type: 'string')]
    private string $value;
}