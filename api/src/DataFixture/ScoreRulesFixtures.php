<?php

declare(strict_types=1);

namespace App\DataFixture;

use App\Entity\ScoreRules;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ScoreRulesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $phoneOperators = $this->getPhoneOperators();

        foreach ($phoneOperators as $phoneOperator) {
            if (!empty($phoneOperator['value'])) {
                foreach ($phoneOperator['value'] as $codeOperator) {
                    $scoreRule = new ScoreRules();

                    $scoreRule->setName($phoneOperator['name']);
                    $scoreRule->setType($phoneOperator['type']);
                    $scoreRule->setValue((string)$codeOperator);
                    $scoreRule->setScore($phoneOperator['score']);

                    $manager->persist($scoreRule);
                }
            } else {
                $scoreRule = new ScoreRules();

                $scoreRule->setName($phoneOperator['name']);
                $scoreRule->setType($phoneOperator['type']);
                $scoreRule->setScore($phoneOperator['score']);

                $manager->persist($scoreRule);
            }

        }

        $emails = $this->getEmails();
        $this->add($emails, $manager);

        $educations = $this->getEducations();
        $this->add($educations, $manager);

        $agreements = $this->getAgreements();
        $this->add($agreements, $manager);

        $manager->flush();
    }

    private function getPhoneOperators(): array
    {
        return [
            [
                'type' => 'phone',
                'name' => 'МегаФон',
                'value' => ['920', '921', '922', '923', '924'],
                'score' => 10,
            ],
            [
                'type' => 'phone',
                'name' => 'Билайн',
                'value' => ['900', '902', '903', '904', '905', '906'],
                'score' => 5
            ],
            [
                'type' => 'phone',
                'name' => 'МТС',
                'value' => ['978', '980', '981', '982', '983'],
                'score' => 3
            ],
            [
                'type' => 'phone',
                'name' => 'other',
                'value' => [],
                'score' => 1
            ]
        ];
    }

    public function getEmails(): array
    {
        return [
            [
                'type' => 'email',
                'name' => 'gmail',
                'value' => 'gmail',
                'score' => 10
            ],
            [
                'type' => 'email',
                'name' => 'yandex',
                'value' => 'yandex',
                'score' => 8
            ],
            [
                'type' => 'email',
                'name' => 'mail',
                'value' => 'mail',
                'score' => 6
            ],
            [
                'type' => 'email',
                'name' => 'other',
                'value' => '',
                'score' => 3
            ]
        ];
    }


    private function getEducations(): array
    {
        return [
            [
                'type' => 'education',
                'name' => 'Высшее образование',
                'value' => 'higher',
                'score' => 15
            ],
            [
                'type' => 'education',
                'name' => 'Специальное образование',
                'value' => 'special',
                'score' => 10
            ],
            [
                'type' => 'education',
                'name' => 'Среднее образование',
                'value' => 'secondary',
                'score' => 5
            ]
        ];
    }

    private function getAgreements(): array
    {
        return [
            [
                'type' => 'agreement',
                'name' => 'Дал согласие',
                'value' => '1',
                'score' => 4
            ],
            [
                'type' => 'agreement',
                'name' => 'other',
                'value' => null,
                'score' => 0
            ]
        ];
    }

    public function add(array $items, ObjectManager $manager)
    {
        foreach ($items as $item) {
            $scoreRule = new ScoreRules();

            $scoreRule->setName($item['name']);
            $scoreRule->setType($item['type']);
            $scoreRule->setValue($item['value']);
            $scoreRule->setScore($item['score']);

            $manager->persist($scoreRule);
        }
    }
}