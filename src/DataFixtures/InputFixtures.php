<?php
/**
 * Input fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Input;
use Doctrine\Persistence\ObjectManager;

/**
 * Class InputFixtures.
 */
class InputFixtures extends AbstractBaseFixtures
{
    /**
     * Load data.
     *
     * @param ObjectManager $manager Persistence object manager
     */
    public function loadData(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; ++$i) {
            $input = new Input();
            $input->setTitle($this->faker->sentence);
            $input->setDescription($this->faker->paragraph);
            $manager->persist($input);
        }

        $manager->flush();
    }
}
