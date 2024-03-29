<?php
/**
 * Movement service interface.
 */

namespace App\Service;

use App\Entity\Movement;
use Knp\Component\Pager\Pagination\PaginationInterface;

/**
 * Interface MovementServiceInterface.
 */
interface MovementServiceInterface
{
    /**
     * Get paginated list.
     *
     * @param int $page Page number
     *
     * @return PaginationInterface<string, mixed> Paginated list
     */
    public function getPaginatedList(int $page): PaginationInterface;

    /**
     * Save entity.
     *
     * @param Movement $movement Movement entity
     */
    public function save(Movement $movement): void;

    /**
     * Can Movement be deleted?
     *
     * @param Movement $movement Movement entity
     *
     * @return bool Result
     */
    public function canBeDeleted(Movement $movement): bool;

    /**
     * Delete entity.
     *
     * @param Movement $movement Movement entity
     */
    public function delete(Movement $movement): void;
}
