<?php

declare(strict_types=1);

namespace App\Command\SignUp;

use App\Interfaces\CommandInterface;

class Command implements CommandInterface
{
    public string $firstName;

    public string $lastName;

    public string $phone;

    public string $email;

    public string $educationType;

    public string $password;

    public string $agreement;

    public function __construct(array $data)
    {
        $this->firstName = !empty($data['firstName']) ? $data['firstName'] : null;
        $this->lastName = !empty($data['lastName']) ? $data['lastName'] : null;
        $this->phone = !empty($data['phone']) ? $data['phone'] : null;
        $this->email = !empty($data['email']) ? $data['email'] : null;
        $this->educationType = !empty($data['educationType']) ? $data['educationType'] : null;
        $this->password = !empty($data['password']) ? $data['password'] : null;
        $this->agreement = !empty($data['agreement']) ? $data['agreement'] : null;
    }
}
