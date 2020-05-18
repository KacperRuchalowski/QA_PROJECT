<?php
/**
 * Question fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Question;
use Doctrine\Persistence\ObjectManager;

/**
 * Class QuestionFixtures.
 */
class QuestionFixture extends AbstractBaseFixtures
{
    /**
     * Load data.
     *
     * @param \Doctrine\Persistence\ObjectManager $manager Persistence object manager
     */
    public function loadData(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; ++$i) {
            $task = new Question();
            $task->setContent($this->faker->sentence);
            $task->setTitleQuestion($this->faker->sentence);
            $this->manager->persist($task);
        }

        $manager->flush();
    }
}