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
     * Get paginated list.
     *
     * @param int $page Page number
     *
     * @return PaginationInterface<string, mixed> Paginated list
     */
    public function getPaginatedList(int $page): PaginationInterface;

    /**
     * Can Field be deleted?
     *
     * @param Field $field Field entity
     *
     * @return bool Result
     */
    public function canBeDeleted(Field $field): bool;

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
