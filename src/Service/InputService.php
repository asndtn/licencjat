<?php
/**
 * Input service.
 */

namespace App\Service;

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

    public function __construct(InputRepository $inputRepository, PaginatorInterface $paginator)
    {
        $this->inputRepository = $inputRepository;
        $this->paginator = $paginator;
    }

    public function getPaginatedList(int $page): PaginationInterface
    {
        return $this->paginator->paginate(
            $this->inputRepository->queryAll(),
            $page,
            InputRepository::PAGINATOR_ITEMS_PER_PAGE
        );
    }
}
