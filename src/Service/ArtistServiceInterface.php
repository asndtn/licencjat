<?php
/**
 * Artist service interface.
 */

namespace App\Service;

use App\Entity\Artist;
use Knp\Component\Pager\Pagination\PaginationInterface;

/**
 * Interface ArtistServiceInterface.
 */
interface ArtistServiceInterface
{
    /**
     * @param int $page Page number
     *
     * @return PaginationInterface<string, mixed> Paginated list
     */
    public function getPaginatedList(int $page): PaginationInterface;

    /**
     * Save entity.
     *
     * @param Artist $artist Artist entity
     */
    public function save(Artist $artist): void;

    /**
     * Delete entity.
     *
     * @param Artist $artist Artist entity
     */
    public function delete(Artist $artist): void;
}
