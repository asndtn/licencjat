<?php
/**
 * Input fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Input;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * Class InputFixtures.
 */
class InputFixtures extends AbstractBaseFixtures implements DependentFixtureInterface
{
    /**
     * Load data.
     *
     * @psalm-suppress PossiblyNullPropertyFetch
     * @psalm-suppress PossiblyNullReference
     * @psalm-suppress UnusedClosureParam
     */
    public function loadData(): void
    {

        if (null === $this->manager || null === $this->faker) {
            return;
        }

        $this->createMany(100, 'inputs', function (int $i) {
            $input = new Input();
            $input->setTitle($this->faker->sentence);
            $input->setDescription($this->faker->sentence);

            /** @var $category */
            $category = $this->getRandomReference('categories');
            $input->setCategory($category);

            /** @var $field */
            $field = $this->getRandomReference('fields');
            $input->setField($field);

            return $input;
        });

        $this->manager->flush();
    }

    public function getDependencies(): array
    {
        return [CategoryFixtures::class];
    }
}
