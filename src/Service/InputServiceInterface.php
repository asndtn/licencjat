<?php
/**
 * Input service interface.
 */

namespace App\Service;

use App\Entity\Input;
use App\Entity\User;
use Knp\Component\Pager\Pagination\PaginationInterface;

/**
 * Interface InputServiceInterface.
 */
interface InputServiceInterface
{
    /**
     * Get paginated list.
     *
     * @param int $page Page number
     * @param array $filters Filters
     *
     * @return PaginationInterface<string, mixed> Paginated list
     */
    public function getPaginatedList(int $page, array $filters = []): PaginationInterface;

    /**
     * Save entity.
     *
     * @param Input $input Input entity
     */
    public function save(Input $input): void;

    /**
     * Delete entity.
     *
     * @param Input $input Input entity
     */
    public function delete(Input $input): void;

    /**
     * Prepare fiers for the inputs list.
     *
     * @param array $filters Filters
     *
     * @return array
     */
    public function prepareFilters(array $filters): array;
}
