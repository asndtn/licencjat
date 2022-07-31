<?php
/**
 * Artist fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Artist;
use App\Entity\Nationality;
use App\Service\FileUploader;
use DateTimeImmutable;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Class ArtistFixtures.
 *
 * @psalm-suppress MissingConstructor
 */
class ArtistFixtures extends AbstractBaseFixtures implements DependentFixtureInterface
{
    private static array $artistPhotos = [
        'frida.jpg',
        'haring.jpg',
        'j-m-basquiat.jpeg',
        'munch.jpg',
        'osiecka.jpg',
        'plath.jpeg',
        'poe.jpeg',
        'przybyszewski.png',
        'rothko.png',
        'virginia.jpg',
        'vonnegut.jpeg',
    ];

    /**
     * File uploader.
     *
     * @var FileUploader File uploader
     */
    private FileUploader $fileUploader;

    /**
     * Constructor.
     */
    public function __construct(FileUploader $fileUploader)
    {
        $this->fileUploader = $fileUploader;
    }

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

            $artistPhoto = $this->fakeUploadImage();
            /* @var string $artistPhoto */
            $artist->setPhotoFilename($artistPhoto);

            return $artist;
        });

        $this->manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on.
     *
     * @return string[] of dependencies
     *
     * @psalm-return array{0: NationalityFixtures::class}
     */
    public function getDependencies(): array
    {
        return [NationalityFixtures::class];
    }

    /**
     * Fake upload.
     *
     * @return string Path
     */
    private function fakeUploadImage(): string
    {
        $randomImage = $this->faker->randomElement(self::$artistPhotos);
        $fs = new Filesystem();
        $targetPath = sys_get_temp_dir().'/'.$randomImage;
        $fs->copy(__DIR__.'/images/'.$randomImage, $targetPath, true);

        return $this->fileUploader
            ->upload(new File($targetPath));
    }
}
