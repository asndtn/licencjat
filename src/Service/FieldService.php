<?php
/**
 * Field service.
 */

namespace App\Service;

use App\Entity\Field;
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
     */
    private FieldRepository $fieldRepository;

    /**
     * Paginator.
     */
    private PaginatorInterface $paginator;

    /**
     * Constructor.
     *
     * @param FieldRepository    $fieldRepository Field repository
     * @param PaginatorInterface $paginator       Paginator
     */
    public function __construct(FieldRepository $fieldRepository, PaginatorInterface $paginator)
    {
        $this->fieldRepository = $fieldRepository;
        $this->paginator = $paginator;
    }

    /**
     * Get paginated list.
     *
     * @param int $page Page number
     *
     * @return PaginationInterface<string, mixed> Paginated list
     */
    public function getPaginatedList(int $page): PaginationInterface
    {
        return $this->paginator->paginate(
            $this->fieldRepository->queryAll(),
            $page,
            FieldRepository::PAGINATOR_ITEMS_PER_PAGE
        );
    }

    /**
     * Save entity.
     *
     * @param Field $field Field entity
     */
    public function save(Field $field): void
    {
        $this->fieldRepository->save($field);
    }

    /**
     * Delete entity.
     *
     * @param Field $field Field entity
     */
    public function delete(Field $field): void
    {
        $this->fieldRepository->delete($field);
    }
}
