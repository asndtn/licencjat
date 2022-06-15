<?php
/**
 * Nationality service interface.
 */

namespace App\Service;

use App\Entity\Nationality;
use Knp\Component\Pager\Pagination\PaginationInterface;

/**
 * Interface NationalityServiceInterface.
 */
interface NationalityServiceInterface
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
     * Can Nationality be deleted?
     *
     * @param Nationality $nationality Nationality entity
     *
     * @return bool Result
     */
    public function canBeDeleted(Nationality $nationality): bool;

    /**
     * Save entity.
     *
     * @param Nationality $nationality Nationality entity
     */
    public function save(Nationality $nationality): void;

    /**
     * Delete entity.
     *
     * @param Nationality $nationality Nationality entity
     */
    public function delete(Nationality $nationality): void;
}
