<?php
/**
 * Input fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Artist;
use App\Entity\Category;
use App\Entity\Field;
use App\Entity\Input;
use App\Entity\Movement;
use App\Entity\Tag;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

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

        $this->createMany(50, 'inputs', function (int $i) {
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

            /** @var array<array-key, Tag> $tags */
            $tags = $this->getRandomReferences('tags', $this->faker->numberBetween(0, 5));
            foreach ($tags as $tag) {
                $input->addTag($tag);
            }

            $author = $this->getRandomReference('users');
            $input->setAuthor($author);

            return $input;
        });

        $this->manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on.
     *
     * @return string[] of dependencies
     *
     * @psalm-return array{0: CategoryFixtures::class, 1: TagFixtures::class, 2: UserFixtures::class}
     */
    public function getDependencies(): array
    {
        return [CategoryFixtures::class, FieldFixtures::class, MovementFixtures::class, ArtistFixtures::class, TagFixtures::class, UserFixtures::class];
    }
}
