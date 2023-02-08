<?php

declare(strict_types=1);

namespace App\Command\SignUp;

use App\Exception\UserAlreadyExistsException;
use App\Interfaces\CommandHandleInterface;
use App\Interfaces\CommandInterface;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class Handle implements CommandHandleInterface
{
    private UserRepository $userRepository;
    private UserPasswordHasherInterface $hasher;
    private EntityManagerInterface $entityManager;

    public function __construct(
        UserRepository $userRepository,
        UserPasswordHasherInterface $hasher,
        EntityManagerInterface $entityManager
    ) {
        $this->userRepository = $userRepository;
        $this->hasher = $hasher;
        $this->entityManager = $entityManager;
    }

    /**
     * @param Command $command
     * @return void
     */
    public function handle(CommandInterface $command)
    {
        if ($this->userRepository->existsByEmail($command->email)) {
            throw new UserAlreadyExistsException();
        }
    }
}