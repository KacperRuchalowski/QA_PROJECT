<?php
/**
 * Task fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Question;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * Class QuestionFixtures.
 */
class QuestionFixture extends AbstractBaseFixtures implements DependentFixtureInterface
{
    /**
     * Load data.
     *
     * @param ObjectManager $manager Persistence object manager
     */
    public function loadData(ObjectManager $manager): void
    {
        $this->createMany(50, 'questions', function ($i) {
            $task = new Question();
            $task->setTitleQuestion($this->faker->word);
            $task->setContent($this->faker->sentence);
            $task->setCategory($this->getRandomReference('categories'));
            $task->setCreatedAt($this->faker->dateTimeBetween('-100 days', '-1 days'));

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
        return [CategoryFixtures::class];
    }
}
