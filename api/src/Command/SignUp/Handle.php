<?php

declare(strict_types=1);

namespace App\Command\SignUp;

use App\Entity\User;
use App\Exception\IncorrectEducationTypeException;
use App\Exception\UserAlreadyExistsException;
use App\Interfaces\CommandHandleInterface;
use App\Interfaces\CommandInterface;
use App\Repository\EducationTypeRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class Handle implements CommandHandleInterface
{
    public function __construct(
        private UserRepository $userRepository,
        private EducationTypeRepository$educationTypeRepository,
        private UserPasswordHasherInterface $hasher,
        private EntityManagerInterface $entityManager,
        private ValidatorInterface $validator
    ) {}

    /**
     * @param Command $command
     * @return void
     */
    public function handle(CommandInterface $command)
    {
        if ($this->userRepository->existsByEmail($command->email)) {
            throw new UserAlreadyExistsException();
        }

        if (empty($command->educationType)) {
            throw new IncorrectEducationTypeException();
        }

        $educationType = $this->educationTypeRepository->findOneBy(['type' => $command->educationType]);

        if (empty($educationType)) {
            throw new IncorrectEducationTypeException();
        }

        $userEntity = User::create(
            $command->firstName,
            $command->lastName,
            $command->phone,
            $command->email,
            $educationType,
            $command->agreement,
        );

        $hashedPassword = $this->hasher->hashPassword(
            $userEntity,
            $command->password
        );

        $userEntity->setPassword($hashedPassword);

        echo "<pre>";
        print_r($userEntity);
        echo "</pre>";

        $errors = $this->validator->validate($userEntity);

        echo "<pre>";
        print_r($errors);
        echo "</pre>";
        die();

        if (count($errors) > 0) {

        }

        $this->entityManager->persist($userEntity);
        $this->entityManager->flush();
    }
}