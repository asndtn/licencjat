<?php
/**
 * Input fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Field;
use App\Entity\Input;
use App\Entity\Movement;
use App\Entity\Artist;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

/**
 * Class InputFixtures.
 *
 * @psalm-suppress MissingConstructor
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

            /** @var Category $category */
            $category = $this->getRandomReference('categories');
            $input->setCategory($category);

            /** @var Field $field */
            $field = $this->getRandomReference('fields');
            $input->setField($field);

            /** @var Movement $movement */
            $movement = $this->getRandomReference('movements');
            $input->setMovement($movement);

            /** @var Artist $artist */
            $artist = $this->getRandomReference('artists');
            $input->setArtist($artist);

            return $input;
        });

        $this->manager->flush();
    }

    public function getDependencies(): array
    {
        return [CategoryFixtures::class, FieldFixtures::class, MovementFixtures::class, ArtistFixtures::class];
    }
}
