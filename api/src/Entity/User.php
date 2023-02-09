<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Table(name: '`user`')]
#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
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

    #[Assert\NotBlank]
    #[ORM\Column(type: 'string')]
    private string $password;

    #[Assert\NotBlank]
    #[ORM\ManyToOne(targetEntity: EducationType::class, inversedBy: 'users')]
    private EducationType $educationType;

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

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
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

    public function setTypeEducation(EducationType $educationType): void
    {
        $this->educationType = $educationType;
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

    public function getUserIdentifier(): int
    {
        return $this->id;
    }

    public static function create(
        string $firstName,
        string $lastName,
        string $phone,
        string $email,
        bool $agreement
    ):self {
        $self = new self();

        $self->firstName = $firstName;
        $self->lastName = $lastName;
        $self->phone = $phone;
        $self->email = $email;
        $self->agreement = $agreement;

        return $self;
    }
}