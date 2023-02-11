<?php

declare(strict_types=1);

namespace App\DataFixture;

use App\Entity\EducationType;
use App\Entity\User;
use App\Repository\EducationTypeRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    private const HASH_PASSWORD = '$2y$13$byLpQmTiZKFMtUb5iCt.uOBZ4o5ab68PMGQgQRQKA16Cizx27CiEO'; // 123
    public function __construct(private EducationTypeRepository $educationTypeRepository)
    {
    }
    public function load(ObjectManager $manager)
    {
        $educationTypes = $this->getEducationTypes();
        $users = $this->getUsers();

        foreach ($users as $user) {
            $userEntity = new User();

            $userEntity->setFirstName($user['first_name']);
            $userEntity->setLastName($user['last_name']);
            $userEntity->setEducationType($educationTypes[$user['education_type']]);
            $userEntity->setPhone($user['phone']);
            $userEntity->setEmail($user['email']);
            $userEntity->setPassword($user['password']);
            $userEntity->setAgreement((bool)$user['agreement']);

            $manager->persist($userEntity);
        }

        $manager->flush();
    }

    private function getUsers(): array
    {
        return [
            [
                'first_name' => 'Александр',
                'last_name' => 'Смирнов',
                'education_type' => 'higher',
                'phone' => '89203245573',
                'email' => 'user@gmal.com',
                'password' => static::HASH_PASSWORD,
                'agreement' => rand(0, 1)
            ],
            [
                'first_name' => 'Владимир',
                'last_name' => 'Смирнов',
                'education_type' => 'special',
                'phone' => '89203245573',
                'email' => 'user1@yandex.com',
                'password' => static::HASH_PASSWORD,
                'agreement' => rand(0, 1)
            ],
            [
                'first_name' => 'Татьяна',
                'last_name' => 'Свиридова',
                'education_type' => 'secondary',
                'phone' => '89023245573',
                'email' => 'user2@gmal.com',
                'password' => static::HASH_PASSWORD,
                'agreement' => rand(0, 1)
            ],
            [
                'first_name' => 'Михаил',
                'last_name' => 'Туров',
                'education_type' => 'higher',
                'phone' => '89203245573',
                'email' => 'user3@pilot.com',
                'password' => static::HASH_PASSWORD,
                'agreement' => rand(0, 1)
            ],
            [
                'first_name' => 'Галина',
                'last_name' => 'Семенова',
                'education_type' => 'special',
                'phone' => '82303245573',
                'email' => 'user4@yandex.com',
                'password' => static::HASH_PASSWORD,
                'agreement' => rand(0, 1)
            ],
            [
                'first_name' => 'Поликарп',
                'last_name' => 'Еланьев',
                'education_type' => 'secondary',
                'phone' => '89213245573',
                'email' => 'user5@mail.com',
                'password' => static::HASH_PASSWORD,
                'agreement' => rand(0, 1)
            ],
            [
                'first_name' => 'Ольга',
                'last_name' => 'Пронина',
                'education_type' => 'higher',
                'phone' => '89783245573',
                'email' => 'user6@gmal.com',
                'password' => static::HASH_PASSWORD,
                'agreement' => rand(0, 1)
            ],
            [
                'first_name' => 'Афанасий',
                'last_name' => 'Пулин',
                'education_type' => 'higher',
                'phone' => '89783245573',
                'email' => 'user7@yandex.com',
                'password' => static::HASH_PASSWORD,
                'agreement' => rand(0, 1)
            ],
            [
                'first_name' => 'Глеб',
                'last_name' => 'Правков',
                'education_type' => 'secondary',
                'phone' => '89023245573',
                'email' => 'user8@mail.com',
                'password' => static::HASH_PASSWORD,
                'agreement' => rand(0, 1)
            ],
            [
                'first_name' => 'Зинаида',
                'last_name' => 'Светличная',
                'education_type' => 'special',
                'phone' => '89833245573',
                'email' => 'user9@mail.com',
                'password' => static::HASH_PASSWORD,
                'agreement' => rand(0, 1)
            ],
            [
                'first_name' => 'Годимир',
                'last_name' => 'Огнеяр',
                'education_type' => 'higher',
                'phone' => '89053245573',
                'email' => 'user10@gmal.com',
                'password' => static::HASH_PASSWORD,
                'agreement' => rand(0, 1)
            ],
            [
                'first_name' => 'Феофан',
                'last_name' => 'Елезаров',
                'education_type' => 'secondary',
                'phone' => '89833245573',
                'email' => 'user11@gmal.com',
                'password' => static::HASH_PASSWORD,
                'agreement' => rand(0, 1)
            ],
            [
                'first_name' => 'Владимир',
                'last_name' => 'Долгорукий',
                'education_type' => 'special',
                'phone' => '89203245573',
                'email' => 'user12@mail.com',
                'password' => static::HASH_PASSWORD,
                'agreement' => rand(0, 1)
            ],
            [
                'first_name' => 'Святополк',
                'last_name' => 'Рюрикович',
                'education_type' => 'higher',
                'phone' => '89053245573',
                'email' => 'user13@yandex.com',
                'password' => static::HASH_PASSWORD,
                'agreement' => rand(0, 1)
            ],
            [
                'first_name' => 'Агрофена',
                'last_name' => 'Земелькина',
                'education_type' => 'secondary',
                'phone' => '89833245573',
                'email' => 'user14@gmal.com',
                'password' => static::HASH_PASSWORD,
                'agreement' => rand(0, 1)
            ],
            [
                'first_name' => 'Поликарп',
                'last_name' => 'Иванов',
                'education_type' => 'higher',
                'phone' => '87203245573',
                'email' => 'user15@yandex.com',
                'password' => static::HASH_PASSWORD,
                'agreement' => rand(0, 1)
            ],
            [
                'first_name' => 'Татьяна',
                'last_name' => 'Доронина',
                'education_type' => 'special',
                'phone' => '89783245573',
                'email' => 'user16@yandex.com',
                'password' => static::HASH_PASSWORD,
                'agreement' => rand(0, 1)
            ],
            [
                'first_name' => 'Серафим',
                'last_name' => 'Дерябин',
                'education_type' => 'higher',
                'phone' => '89053245573',
                'email' => 'user17@gmal.com',
                'password' => static::HASH_PASSWORD,
                'agreement' => rand(0, 1)
            ],[
                'first_name' => 'Борис',
                'last_name' => 'Туров',
                'education_type' => 'secondary',
                'phone' => '89833245573',
                'email' => 'user18@mail.com',
                'password' => static::HASH_PASSWORD,
                'agreement' => rand(0, 1)
            ],[
                'first_name' => 'Юлия',
                'last_name' => 'Туктамышева',
                'education_type' => 'special',
                'phone' => '89203245573',
                'email' => 'user19@yandex.com',
                'password' => static::HASH_PASSWORD,
                'agreement' => rand(0, 1)
            ],
            [
                'first_name' => 'Елена',
                'last_name' => 'Новгородская',
                'education_type' => 'higher',
                'phone' => '89203245573',
                'email' => 'user20@gmal.com',
                'password' => static::HASH_PASSWORD,
                'agreement' => rand(0, 1)
            ],[
                'first_name' => 'Елисей',
                'last_name' => 'Попов',
                'education_type' => 'secondary',
                'phone' => '85203245573',
                'email' => 'user21@yandex.com',
                'password' => static::HASH_PASSWORD,
                'agreement' => rand(0, 1)
            ]
        ];
    }

    private function getEducationTypes(): array
    {
        $educationTypes = $this->educationTypeRepository->findAll();
        $associatedEducationTypes = [];

        /** @var EducationType $educationType */
        foreach ($educationTypes as $educationType) {
            $associatedEducationTypes[$educationType->getType()] = $educationType;
        }

        return $associatedEducationTypes;
    }

    public function getDependencies()
    {
        return [
            EducationTypeFixtures::class
        ];
    }
}