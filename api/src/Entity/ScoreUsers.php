<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ScoreUsersRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: '`score_users`')]
#[ORM\Entity(repositoryClass: ScoreUsersRepository::class)]
class ScoreUsers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\OneToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name:'user_id', referencedColumnName: 'id', onDelete: 'cascade')]
    private User $user;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $phoneScore;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $emailScore;

    #[ORM\Column(type: 'integer')]
    private int $educationScore;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $agreementScore;

    #[ORM\Column(type: 'integer')]
    private int $totalScore;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getPhoneScore(): ?int
    {
        return $this->phoneScore;
    }

    public function setPhoneScore(?int $phoneScore): void
    {
        $this->phoneScore = $phoneScore;
    }

    public function getEmailScore(): ?int
    {
        return $this->emailScore;
    }

    public function setEmailScore(?int $emailScore): void
    {
        $this->emailScore = $emailScore;
    }

    public function getEducationScore(): int
    {
        return $this->educationScore;
    }

    public function setEducationScore(int $educationScore): void
    {
        $this->educationScore = $educationScore;
    }

    public function getAgreementScore(): ?int
    {
        return $this->agreementScore;
    }

    public function setAgreementScore(?int $agreementScore): void
    {
        $this->agreementScore = $agreementScore;
    }

    public function getTotalScore(): int
    {
        return $this->totalScore;
    }

    public function setTotalScore(int $totalScore): void
    {
        $this->totalScore = $totalScore;
    }
}