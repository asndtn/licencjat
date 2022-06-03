<?php
/**
 * Movement fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Movement;

/**
 * Class MovementFixtures.
 *
 * @psalm-suppress MissingConstructor
 */
class MovementFixtures extends AbstractBaseFixtures
{
    /**
     * Load data.
     *
     * @psalm-suppress PossiblyNullReference
     * @psalm-suppress UnusedClosureParam
     */
    public function loadData(): void
    {
        $this->createMany(20, 'movements', function (int $i) {
            $movement = new Movement();
            $movement->setName($this->faker->unique()->word);

            return $movement;
        });

        $this->manager->flush();
    }
}
