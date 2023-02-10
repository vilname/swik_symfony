<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\EducationType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EducationTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $educationType = new EducationType();
        $educationType->setName('Высшее образование');
        $educationType->setType('higher');
        $manager->persist($educationType);

        $educationType = new EducationType();
        $educationType->setName('Специальное образование');
        $educationType->setType('special');
        $manager->persist($educationType);

        $educationType = new EducationType();
        $educationType->setName('Среднее образование');
        $educationType->setType('secondary');
        $manager->persist($educationType);

        $manager->flush();
    }
}