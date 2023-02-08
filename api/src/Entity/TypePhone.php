<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: '`type_phone`')]
#[ORM\Entity]
class TypePhone
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string')]
    private string $name;

    #[ORM\OneToMany(mappedBy: 'typePhone', targetEntity: TypePhoneCode::class)]
    private ArrayCollection $typePhoneCode;

    public function __construct()
    {
        $this->typePhoneCode = new ArrayCollection();
    }

    /**
     * @return Collection
     */
    public function getProducts(): Collection
    {
        return $this->typePhoneCode;
    }
}