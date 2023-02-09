<?php

declare(strict_types=1);

namespace App\Command\SignUp;

use App\Entity\User;
use App\Exception\UserAlreadyExistsException;
use App\Interfaces\CommandHandleInterface;
use App\Interfaces\CommandInterface;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class Handle implements CommandHandleInterface
{
    private UserRepository $userRepository;
    private UserPasswordHasherInterface $hasher;
    private EntityManagerInterface $entityManager;
    private ValidatorInterface $validator;

    public function __construct(
        UserRepository $userRepository,
        UserPasswordHasherInterface $hasher,
        EntityManagerInterface $entityManager,
        ValidatorInterface $validator
    ) {
        $this->userRepository = $userRepository;
        $this->hasher = $hasher;
        $this->entityManager = $entityManager;
        $this->validator = $validator;
    }

    /**
     * @param Command $command
     * @return void
     */
    public function handle(CommandInterface $command)
    {
//        if ($this->userRepository->existsByEmail($command->email)) {
//            throw new UserAlreadyExistsException();
//        }
//
//        $userEntity = User::create(
//            $command->firstName,
//            $command->lastName,
//            $command->phone,
//            $command->email,
//            $command->agreement,
//        );
//
//        $hashedPassword = $this->hasher->hashPassword(
//            $userEntity,
//            $command->password
//        );
//
//        $userEntity->setPassword($hashedPassword);
//
//        $errors = $this->validator->validate($userEntity);
//
//        if (count($errors) > 0) {
//
//        }
//
//        $this->entityManager->persist($userEntity);
//        $this->entityManager->flush();
    }
}