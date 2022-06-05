<?php
/**
 * Field service.
 */

namespace App\Service;

use App\Repository\FieldRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * Class FieldService.
 */
class FieldService implements FieldServiceInterface
{
    /**
     * Field repository.
     *
     * @var FieldRepository
     */
    private FieldRepository $fieldRepository;

    /**
     * Paginator.
     *
     * @var PaginatorInterface
     */
    private PaginatorInterface $paginator;

    public function __construct(FieldRepository $fieldRepository, PaginatorInterface $paginator)
    {
        $this->fieldRepository = $fieldRepository;
        $this->paginator = $paginator;
    }

    public function getPaginatedList(int $page): PaginationInterface
    {
        return $this->paginator->paginate(
            $this->fieldRepository->queryAll(),
            $page,
            FieldRepository::PAGINATOR_ITEMS_PER_PAGE
        );
    }
}
