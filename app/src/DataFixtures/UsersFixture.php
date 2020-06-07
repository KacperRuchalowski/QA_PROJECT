<?php
/**
 * Question fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Persistence\ObjectManager;

/**
 * Class QuestionFixtures.
 */
class UsersFixture extends AbstractBaseFixtures
{
    /**
     * Load data.
     *
     * @param \Doctrine\Persistence\ObjectManager $manager Persistence object manager
     */
    public function loadData(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; ++$i) {
            $task = new Users();
            $task->setLogin($this->faker->sentence);
            $task->setPassword($this->faker->sentence);
            $task->setRoles($this->faker->sentence);
            $this->manager->persist($task);
        }

        $manager->flush();
    }
}