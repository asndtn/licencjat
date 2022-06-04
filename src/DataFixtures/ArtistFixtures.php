<?php
/**
 * Artist fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Artist;
use App\Entity\Nationality;
use DateTimeImmutable;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

/**
 * Class ArtistFixtures.
 *
 * @psalm-suppress MissingConstructor
 */
class ArtistFixtures extends AbstractBaseFixtures implements DependentFixtureInterface
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

            /** @var Nationality $nationality */
            $nationality = $this->getRandomReference('nationalities');
            $artist->setNationality($nationality);

            return $artist;
        });

        $this->manager->flush();
    }

    public function getDependencies(): array
    {
        return [NationalityFixtures::class];
    }
}
