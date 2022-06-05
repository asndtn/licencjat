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
     * @param int $page Page number
     *
     * @return PaginationInterface<string, mixed> Paginated list
     */
    public function getPaginatedList(int $page): PaginationInterface;
}
