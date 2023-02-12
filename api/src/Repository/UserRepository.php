<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

class UserRepository extends EntityRepository
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, $em->getClassMetadata(User::class));
    }

    public function existsByEmail(string $email): bool
    {
        return null !== $this->findOneBy(['email' => $email]);
    }

    public function getQueryList(): Query
    {
        return $this->createQueryBuilderUser()->getQuery();
    }

    /**
     * @return User[]
     */
    public function getUsersByLimit(Query $query, int $pageSize, int $offset): array
    {
        return $query->setMaxResults($pageSize)->setFirstResult($offset)->getResult();
    }

    public function getCountRowInQuery(Query $query): ?int
    {
        return $this->createQueryBuilderUser()->select('count(users.id)')->getQuery()->getSingleScalarResult();
    }

    private function createQueryBuilderUser(): QueryBuilder
    {
        return $this->createQueryBuilder('users')->where('users.score is not null');
    }
}
