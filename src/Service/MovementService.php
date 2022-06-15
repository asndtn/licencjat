<?php
/**
 * Movement service.
 */

namespace App\Service;

use App\Entity\Movement;
use App\Repository\InputRepository;
use App\Repository\MovementRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * Class MovementService.
 */
class MovementService implements MovementServiceInterface
{
    /**
     * Movement repository.
     */
    private MovementRepository $movementRepository;

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
     * @param MovementRepository $movementRepository Movement repository
     * @param PaginatorInterface $paginator          Paginator
     */
    public function __construct(MovementRepository $movementRepository, InputRepository $inputRepository, PaginatorInterface $paginator)
    {
        $this->movementRepository = $movementRepository;
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
            $this->movementRepository->queryAll(),
            $page,
            MovementRepository::PAGINATOR_ITEMS_PER_PAGE
        );
    }

    /**
     * Can Movement be deleted?
     *
     * @param Movement $movement Movement entity
     *
     * @return bool Result
     */
    public function canBeDeleted(Movement $movement): bool
    {
        try {
            $result = $this->inputRepository->countByMovement($movement);

            return !($result > 0);
        } catch (NoResultException|NonUniqueResultException) {
            return false;
        }
    }

    /**
     * Save entity.
     *
     * @param Movement $movement Movement entity
     */
    public function save(Movement $movement): void
    {
        $this->movementRepository->save($movement);
    }

    /**
     * Delete entity.
     *
     * @param Movement $movement Movement entity
     */
    public function delete(Movement $movement): void
    {
        $this->movementRepository->delete($movement);
    }
}
