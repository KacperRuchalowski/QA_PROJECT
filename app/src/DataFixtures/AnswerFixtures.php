<?php
/**
 * Task fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Answer;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * Class QuestionFixtures.
 */
class AnswerFixtures extends AbstractBaseFixtures implements DependentFixtureInterface
{
    /**
     * Load data.
     *
     * @param \Doctrine\Persistence\ObjectManager $manager Persistence object manager
     */
    public function loadData(ObjectManager $manager): void
    {
        $this->createMany(50, 'answers', function ($i) {
            $task = new Answer();
            $task->setIsBest($this->faker->numberBetween(0,1));
            $task->setContent($this->faker->sentence);
            $task->setQuestion($this->getRandomReference('questions'));

            return $task;
        });

        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on.
     *
     * @return array Array of dependencies
     */
    public function getDependencies(): array
    {
        return [QuestionFixture::class];
    }
}