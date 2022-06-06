<?php
/**
 * Field service interface.
 */

namespace App\Service;

use App\Entity\Field;
use Knp\Component\Pager\Pagination\PaginationInterface;

/**
 * Interface FieldServiceInterface.
 */
interface FieldServiceInterface
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
     * @param Field $field Field entity
     */
    public function save(Field $field): void;

    /**
     * Delete entity.
     *
     * @param Field $field Field entity
     */
    public function delete(Field $field): void;
}
