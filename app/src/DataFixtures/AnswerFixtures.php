<?php
/**
 * Question fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Answer;
use Doctrine\Persistence\ObjectManager;

/**
 * Class QuestionFixtures.
 */
class AnswerFixtures extends AbstractBaseFixtures
{
    /**
     * Load data.
     *
     * @param \Doctrine\Persistence\ObjectManager $manager Persistence object manager
     */
    public function loadData(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; ++$i) {
            $task = new Answer();
            $task->setContent($this->faker->sentence);
            $task->setIsBest($this->faker->numberBetween(0 , 1));
            $this->manager->persist($task);
        }

        $manager->flush();
    }
}