<?php
/**
 * Field fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Field;

/**
 * Class FieldFixtures.
 *
 * @psalm-suppress MissingConstructor
 */
class FieldFixtures extends AbstractBaseFixtures
{
    /**
     * Load data.
     *
     * @psalm-suppress PossiblyNullReference
     * @psalm-suppress UnusedClosureParam
     */
    public function loadData(): void
    {
        $this->createMany(20, 'fields', function (int $i) {
            $field = new Field();
            $field->setName($this->faker->unique()->word);

            return $field;
        });

        $this->manager->flush();
    }
}
