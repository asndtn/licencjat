<?php

/**
 * Tag service interface.
 */

namespace App\Service;

use App\Entity\Tag;
use Knp\Component\Pager\Pagination\PaginationInterface;

/**
 * Interface TagServiceInterface.
 */
interface TagServiceInterface
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
//     * @param string $name Tag name
//     *
//     * @return Tag|null Tag entity
//     */
//    public function findOneByName(string $name): ?Tag;

//    /**
//     * Can Tag be deleted?
//     *
//     * @param Tag $tag Tag entity
//     *
//     * @return bool Result
//     */
//    public function canBeDeleted(Tag $tag): bool;

    /**
     * Save entity.
     *
     * @param Tag $tag Tag entity
     */
    public function save(Tag $tag): void;

    /**
     * Delete entity.
     *
     * @param Tag $tag Tag entity
     */
    public function delete(Tag $tag): void;
}
