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
            $task->setLogin($this->faker->word);
            $task->setPassword($this->faker->word);
            $task->setRoles($this->faker->word);
            $this->manager->persist($task);
        }

        $manager->flush();
    }
}