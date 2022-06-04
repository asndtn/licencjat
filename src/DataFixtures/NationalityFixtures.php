<?php
/**
 * Nationality fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Nationality;

/**
 * Class NationalityFixtures.
 *
 * @psalm-suppress MissingConstructor
 */
class NationalityFixtures extends AbstractBaseFixtures
{
    /**
     * Load data.
     *
     * @psalm-suppress PossiblyNullReference
     * @psalm-suppress UnusedClosureParam
     */
    public function loadData(): void
    {
        $this->createMany(20, 'nationalities', function (int $i) {
            $nationality = new Nationality();
            $nationality->setName($this->faker->unique()->country());

            return $nationality;
        });

        $this->manager->flush();
    }
}
