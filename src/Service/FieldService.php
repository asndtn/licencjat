<?php
/**
 * Field service.
 */

namespace App\Service;

use App\Entity\Field;
use App\Repository\FieldRepository;
use App\Repository\InputRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
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
     * InputRepository.
     */
    private InputRepository $inputRepository;

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
    public function __construct(FieldRepository $fieldRepository, InputRepository $inputRepository, PaginatorInterface $paginator)
    {
        $this->fieldRepository = $fieldRepository;
        $this->paginator = $paginator;

        $this->inputRepository = $inputRepository;
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

    /**
     * Can Field be deleted?
     *
     * @param Field $field Field entity
     *
     * @return bool Result
     */
    public function canBeDeleted(Field $field): bool
    {
        try {
            $result = $this->inputRepository->countByField($field);

            return !($result > 0);
        } catch (NoResultException|NonUniqueResultException) {
            return false;
        }
    }
}
