<?php
/**
 * Artist fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Artist;
use DateTimeImmutable;

/**
 * Class ArtistFixtures.
 *
 * @psalm-suppress MissingConstructor
 */
class ArtistFixtures extends AbstractBaseFixtures
{
    /**
     * Load data.
     *
     * @psalm-suppress PossiblyNullReference
     * @psalm-suppress UnusedClosureParam
     */
    public function loadData(): void
    {
        $this->createMany(20, 'artists', function (int $i) {
            $artist = new Artist();
            $artist->setName($this->faker->unique()->name());
            $artist->setDateOfBirth(
                DateTimeImmutable::createFromMutable(
                    $this->faker->dateTimeBetween('-500 years', '-100 years')
                )
            );

            $artist->setDateOfDeath(
                DateTimeImmutable::createFromMutable(
                    $this->faker->dateTimeBetween('-410 years', '-10 years')
                )
            );

            return $artist;
        });

        $this->manager->flush();
    }
}
