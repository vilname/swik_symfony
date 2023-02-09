<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\EducationTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: '`type_educations`')]
#[ORM\Entity(repositoryClass: EducationTypeRepository::class)]
class EducationType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string')]
    private string $name;

    #[ORM\Column(type: 'string')]
    private string $type;

    #[ORM\OneToMany(mappedBy: 'educationType', targetEntity: User::class)]
    private ArrayCollection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getUsers(): ArrayCollection
    {
        return $this->users;
    }
}
