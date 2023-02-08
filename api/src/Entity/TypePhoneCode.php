<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: '`type_phone_code`')]
#[ORM\Entity]
class TypePhoneCode
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'integer')]
    private string $code;

    #[ORM\ManyToOne(targetEntity: TypePhone::class, inversedBy: 'typePhoneCode')]
    private TypePhone $typePhone;

    public function getTypePhone(): TypePhone
    {
        return $this->typePhone;
    }

    public function setTypePhone(TypePhone $typePhone): void
    {
        $this->typePhone = $typePhone;
    }
}