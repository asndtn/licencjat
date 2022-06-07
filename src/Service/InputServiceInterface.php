<?php
/**
 * Input service interface.
 */

namespace App\Service;

use App\Entity\Input;
use Knp\Component\Pager\Pagination\PaginationInterface;

/**
 * Interface InputServiceInterface.
 */
interface InputServiceInterface
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
     * @param Input $input Input entity
     */
    public function save(Input $input): void;

    /**
     * Delete entity.
     *
     * @param Input $input Input entity
     */
    public function delete(Input $input): void;
}
