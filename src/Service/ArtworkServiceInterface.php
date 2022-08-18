<?php

/**
 * Artwork service interface.
 */

namespace App\Service;

use App\Entity\Artwork;
use Knp\Component\Pager\Pagination\PaginationInterface;

/**
 * Interface ArtworkServiceInterface.
 */
interface ArtworkServiceInterface
{
    /**
     * Get paginated list.
     *
     * @param int $page Page number
     *
     * @return PaginationInterface<string, mixed> Paginated list
     */
    public function getPaginatedList(int $page): PaginationInterface;

//    /**
//     * Find by name.
//     *
//     * @param string $name Artwork name
//     *
//     * @return Artwork|null Artwork entity
//     */
//    public function findOneByName(string $name): ?Artwork;

    /**
     * Save entity.
     *
     * @param Artwork $artwork Artwork entity
     */
    public function save(Artwork $artwork): void;

    /**
     * Delete entity.
     *
     * @param Artwork $artwork Artwork entity
     */
    public function delete(Artwork $artwork): void;
}
