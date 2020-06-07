<?php
/**
 * Question fixtures.
 */

namespace App\DataFixtures;

use App\Entity\UserData;
use Doctrine\Persistence\ObjectManager;

/**
 * Class QuestionFixtures.
 */
class UserDataFixtures extends AbstractBaseFixtures
{
    /**
     * Load data.
     *
     * @param \Doctrine\Persistence\ObjectManager $manager Persistence object manager
     */
    public function loadData(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; ++$i) {
            $task = new UserData();
            $task->setNick($this->faker->word);
            $this->manager->persist($task);
        }

        $manager->flush();
    }
}