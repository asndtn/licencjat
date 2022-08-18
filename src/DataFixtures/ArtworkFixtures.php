<?php
/**
 * Artwork fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Artwork;
use App\Entity\Artist;
use App\Service\FileUploader;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Class Artwork fixtures.
 *
 * @psalm-suppress MissingConstructor
 */
class ArtworkFixtures extends AbstractBaseFixtures implements DependentFixtureInterface
{
    private static array $artworks = [
        'flower1.jpg',
        'flower2.jpg',
        'flower3.jpg',
        'flower4.jpg',
        'flower5.jpg',
        'flower6.jpg',
        'flower7.jpg',
        'flower8.jpg',
        'flower9.jpg',
        'flower10.jpg',
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
    protected function loadData(): void
    {
        if (null === $this->manager || null == $this->faker) {
            return;
        }

        $this->createMany(60, 'artworks', function (int $i) {
            $artwork = new Artwork();
            $artwork->setUrl($this->faker->url());

            /** @var Artist $artist */
            $artist = $this->getRandomReference('artists');
            $artwork->setArtist($artist);

            $artworkFilename = $this->fakeUploadImage();
            /** @var string $artworkFilename */
            $artwork->setArtworkFilename($artworkFilename);

            return $artwork;
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
        return [ArtistFixtures::class];
    }

    /**
     * Fake upload.
     *
     * @return string Path
     */
    private function fakeUploadImage(): string
    {
        $randomImage = $this->faker->randomElement(self::$artworks);
        $fs = new Filesystem();
        $targetPath = sys_get_temp_dir().'/'.$randomImage;
        $fs->copy(__DIR__.'/artworks/'.$randomImage, $targetPath, true);

        return $this->fileUploader
            ->upload(new File($targetPath));
    }
}