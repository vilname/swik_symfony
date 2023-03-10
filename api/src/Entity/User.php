<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use JsonSerializable;

#[ORM\Table(name: '`users`')]
#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface, JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[Assert\NotBlank]
    #[ORM\Column(type: 'string')]
    private string $firstName;

    #[Assert\NotBlank]
    #[ORM\Column(type: 'string')]
    private string $lastName;

    #[Assert\NotBlank]
    #[ORM\Column(type: 'string')]
    private string $phone;

    #[Assert\NotBlank]
    #[Assert\Email]
    #[ORM\Column(type: 'string', unique: true)]
    private string $email;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $password;

    #[Assert\NotBlank]
    #[ORM\ManyToOne(targetEntity: EducationType::class, inversedBy: 'users')]
    private EducationType $educationType;

    #[ORM\OneToOne(mappedBy: 'user', targetEntity: ScoreUsers::class)]
    #[ORM\JoinColumn(name:'score_id', referencedColumnName: 'id')]
    private ?ScoreUsers $score;

    #[Assert\NotBlank]
    #[ORM\Column(type: 'boolean', options: ['default' => '0'])]
    private bool $agreement;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getEducationType(): EducationType
    {
        return $this->educationType;
    }

    public function setEducationType(EducationType $educationType): void
    {
        $this->educationType = $educationType;
    }

    public function getScore(): ?ScoreUsers
    {
        return $this->score;
    }

    public function setScore(?ScoreUsers $score): void
    {
        $this->score = $score;
    }

    public function isAgreement(): bool
    {
        return $this->agreement;
    }

    public function setAgreement(bool $agreement): void
    {
        $this->agreement = $agreement;
    }

    public function getRoles(): array
    {
        return [];
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function eraseCredentials()
    {
    }

    public function getUsername(): string
    {
        return $this->email;
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public static function create(
        string $firstName,
        string $lastName,
        string $phone,
        string $email,
        $educationType,
        bool $agreement
    ):self {
        $self = new self();

        $self->firstName = $firstName;
        $self->lastName = $lastName;
        $self->phone = $phone;
        $self->email = $email;
        $self->educationType = $educationType;
        $self->agreement = $agreement;

        return $self;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'phone' => $this->phone,
            'email' => $this->email,
            'educationName' => $this->educationType->getName(),
            'score' => $this->score,
            'agreement' => $this->agreement
        ];
    }
}