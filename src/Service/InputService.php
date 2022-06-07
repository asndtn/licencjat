<?php
/**
 * Input service.
 */

namespace App\Service;

use App\Entity\Input;
use App\Repository\InputRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * Class InputService.
 */
class InputService implements InputServiceInterface
{
    /**
     * Input repository.
     */
    private InputRepository $inputRepository;

    /**
     * Paginator.
     */
    private PaginatorInterface $paginator;

    /**
     * Constructor.
     *
     * @param InputRepository    $inputRepository Input repository
     * @param PaginatorInterface $paginator       Paginator
     */
    public function __construct(InputRepository $inputRepository, PaginatorInterface $paginator)
    {
        $this->inputRepository = $inputRepository;
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
            $this->inputRepository->queryAll(),
            $page,
            InputRepository::PAGINATOR_ITEMS_PER_PAGE
        );
    }

    /**
     * Save entity.
     *
     * @param Input $input Input entity
     */
    public function save(Input $input): void
    {
        $this->inputRepository->save($input);
    }

    /**
     * Delete entity.
     *
     * @param Input $input Input entity
     */
    public function delete(Input $input): void
    {
        $this->inputRepository->delete($input);
    }
}
