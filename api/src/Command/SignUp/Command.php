<?php

declare(strict_types=1);

namespace App\Command\SignUp;

use App\Interfaces\CommandInterface;

class Command implements CommandInterface
{
    private string $firstName;

    private string $lastName;

    private string $phone;

    private string $email;

    private string $educationType;

    private string $password;

    private string $agreement;

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

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getEducationType(): string
    {
        return $this->educationType;
    }

    public function setEducationType(string $educationType): void
    {
        $this->educationType = $educationType;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getAgreement(): string
    {
        return $this->agreement;
    }

    public function setAgreement(string $agreement): void
    {
        $this->agreement = $agreement;
    }

//    public function __construct(array $data)
//    {
//        $this->firstName = !empty($data['firstName']) ? $data['firstName'] : null;
//        $this->lastName = !empty($data['lastName']) ? $data['lastName'] : null;
//        $this->phone = !empty($data['phone']) ? $data['phone'] : null;
//        $this->email = !empty($data['email']) ? $data['email'] : null;
//        $this->educationType = !empty($data['educationType']) ? $data['educationType'] : null;
//        $this->password = !empty($data['password']) ? $data['password'] : null;
//        $this->agreement = !empty($data['agreement']) ? $data['agreement'] : null;
//    }


}
